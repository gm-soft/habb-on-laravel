<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use Artisan;
use Exception;
use Illuminate\Http\Request;
use Log;
use Storage;

class BackupController extends Controller
{
    //  По большей части копипаста с сайта https://laracasts.com/discuss/channels/laravel/how-to-backup-mysql-database#reply=191469

    public function index()
    {
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);

        $files = $disk->files(config('laravel-backup.backup.name'));
        $backups = [];
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('laravel-backup.backup.name') . '/', '', $f),
                    'file_size' => $disk->size($f),
                    'last_modified' => $disk->lastModified($f),
                ];
            }
        }
        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);

        return view("admin.backups.index", ['backups' => $backups]);
    }

    public function create()
    {
        try {
            // start the backup process
            Artisan::call('backup:run');
            $output = Artisan::output();

            // log the results
            Log::info("Backpack\BackupManager -- Вызван бэкап из веб-интерфейса \r\n" . $output);

            // return the results as a response to the ajax call
            flash('Создан новый бэкап', Constants::Success);
            return redirect()->back();

        } catch (Exception $e) {

            flash('Бэкап не получилось создать: '.$e->getMessage(), Constants::Error);
            return redirect()->back();
        }
    }

    /**
     * Downloads a backup zip file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     * @throws \League\Flysystem\FileNotFoundException
     */
    public function download(Request $request)
    {
        $fileName = $request->input('file_name');

        $file = config('laravel-backup.backup.name') . '/' . $fileName;
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);

        if ($disk->exists($file)) {

            $fs = Storage::disk(config('laravel-backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);

            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            abort(404, "Указанный бэкап не найден");
        }
    }

    /**
     * Deletes a backup file.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $fileName = $request->input('file_name');

        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);

        if ($disk->exists(config('laravel-backup.backup.name') . '/' . $fileName)) {
            $disk->delete(config('laravel-backup.backup.name') . '/' . $fileName);
            return redirect()->back();

        } else {
            abort(404, "Указанный бэкап не найден");
        }
    }
}
