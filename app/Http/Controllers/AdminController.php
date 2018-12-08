<?php

namespace App\Http\Controllers;

use App\Helpers\VarDumper;
use App\Models\Gamer;
use App\Models\Post;
use App\ViewModels\Back\AdminHomePageViewModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    const DaysInMonth = 30;

    public function index()
    {
        $model = new AdminHomePageViewModel;
        $model->accounts_count = Gamer::all()->count();
        $model->active_habb_accounts_count = Gamer::getActiveAccounts()->count();
        $model->non_action_habb_accounts_count = $model->accounts_count - $model->active_habb_accounts_count;

        $model->posts_count = Post::all()->count();
        $model->top_viewed_posts = Post::getMostViewed(3);

        $now = Carbon::now();
        $gamers = Gamer::getGamerRowsAfterDate($now->subDays(self::DaysInMonth));

        $gamersByDays = $this->getGamersByCountOfCreationByDay($gamers);

        $model->gamers_by_days_labels = [];
        $model->gamers_by_days_values = [];

        foreach ($gamersByDays as $gbd){
            $model->gamers_by_days_labels[] = $gbd['day'];
            $model->gamers_by_days_values[] = $gbd['count'];
        }

        return view('admin/index', ['model' => $model]);
    }

    /**
     * @param $gamers
     * @return array
     */
    private function getGamersByCountOfCreationByDay($gamers) {

        $gamers = collect($gamers)->map(function ($item, $key) {
            return [
                'id' => $item->id,
                'created_at' => Carbon::parse($item->created_at)
            ];
        });

        $result = [];

        for ($i = 0; $i < self::DaysInMonth; $i++){

            $day = Carbon::today()->subDays(self::DaysInMonth - $i);

            $dayStart = $day->copy();
            $dayStart = $dayStart->setTime(0, 0, 0);

            $dayEnd = $day->copy();
            $dayEnd = $dayEnd->setTime(23, 59, 59);

            $result[] = [
                'day' => $day->format("d/m"),
                'count' => $gamers->filter(function ($value) use ($dayStart, $dayEnd) {

                    /** @var Carbon $created_at */
                    $created_at = $value['created_at'];

                    return $created_at->gt($dayStart) && $created_at->lt($dayEnd);

                })->count()
            ];
        }

        return $result;
    }
}
