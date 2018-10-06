<?php

namespace App\Http\Controllers;

use App\ViewModels\Back\Upload\FileItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect;
use Storage;

class UploadController extends Controller
{
    public function index(){

        $result = $this->getFilesAsArray();

        return view('admin.upload.index', ['files' => $result]);
    }

    public function getImagesAsJsonArray(){
        $result = $this->getFilesAsArray();

        return response()->json($result);
    }

    /**
     * @return array|FileItem[]
     */
    private function getFilesAsArray(){
        $imageStorage = Storage::disk('public_images');
        $fileNames = $imageStorage->files();

        $result = array();

        foreach ($fileNames as $fileName){

            $item = new FileItem();

            $item->filepath = $imageStorage->url($fileName);

            $item->size = $imageStorage->size($fileName);

            $item->lastModified = Carbon::createFromTimestamp($imageStorage->lastModified($fileName));

            $result[] = $item;
        }

        return $result;
    }

    public function page(){

        return view('admin.upload.page');
    }

    public function store(Request $request) {

        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('file') && $request->file('file')->isValid()) {

            $file = $request->file('file');

            $filename = time().".".$file->getClientOriginalName();

            // $path = $file->storeAs(public_path('images'), $filename);

            $path = $file->move(public_path('images'), $filename);

            return Redirect::action('UploadController@index')->with('success', 'Данные сохранены: '.$path);
        }

        return Redirect::action('UploadController@page')->with('error','Произошли ошибки при загружке. Попробуйте еще раз');

    }
}
