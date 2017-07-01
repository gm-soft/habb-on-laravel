<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Models\Post;
use App\ViewModels\Front\RatingViewModelBase;
use App\ViewModels\Front\TeamRatingViewModel;
use App\ViewModels\NewsViewModel;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    #region Посты
    public function openPost($id){
        /** @var Post $post */
        $post = Post::find($id);

        $user = \Auth::user();
        if (\Auth::guest() || !$user->hasBackendRight()) {
            $post->views = $post->views+1;
            $post->save();
        }
        $post->decodeHtmlContent();


        return view('front.posts.show', ["post" => $post]);
    }

    public function news() {
        $posts = Post::all();
        foreach ($posts as $post) {
            $post->decodeHtmlContent();
        }
        $model = new NewsViewModel($posts);

        return view('front.posts.index', ["model" => $model]);
    }
    #endregion

    #region Рейтинги
    public function gamerRating($game = Constants::CsGo){
        $rating = \DB::table('gamers')->select('gamers.id', 'name', 'last_name', 'city', 'gamer_scores.total_value', 'gamer_scores.total_change')
            ->join('gamer_scores', 'gamers.id', '=', 'gamer_scores.gamer_id')
            ->where('gamer_scores.game_name', '=', $game)
            ->where('gamer_scores.total_value', '>', 0)
            ->orderBy('gamer_scores.total_value', 'desc')
            ->get();

        $graterPoint = [];
        $bellowTheLine = [];
        foreach ($rating as $item) {
            if ($item->total_value > 5) $graterPoint[] = $item;
            else $bellowTheLine[] = $item;
        }

        $model = new RatingViewModelBase();
        $model->game = $game;
        $model->greater = $graterPoint;
        $model->bellow = $bellowTheLine;

        return view('front.rating.gamer', [ 'model' => $model ]);
    }

    public function teamRating($game = Constants::CsGo){

        $model = new TeamRatingViewModel();
        $model->game = $game;
        $rating = \DB::table('teams')
            ->join('team_scores', 'teams.id', '=', 'team_scores.team_id')
            ->where('team_scores.game_name', '=', $game)
            ->where('team_scores.total_value', '>', 0)
            ->orderBy('team_scores.total_value', 'desc')
            ->get();

        $model->gamers = [];

        foreach ($rating as $item) {
            $gamerIds = explode(', ', $item->gamer_ids);
            $gamerRoles = explode(', ', $item->gamer_roles);
            $gamersToAdd = [];

            for($i = 0; $i < count($gamerIds); $i++) {
                $id = $gamerIds[$i];
                $role = $gamerRoles[$i];

                if ($role == 'coach' || $role == 'reserve') continue;

                $row = \DB::table('gamers')->select('gamers.id', 'name', 'last_name', 'city', 'gamer_scores.total_value', 'gamer_scores.total_change')
                    ->where('gamers.id', '=', $id)
                    ->join('gamer_scores', 'gamers.id', '=', 'gamer_scores.gamer_id')
                    ->where('gamer_scores.game_name', '=', $game)
                    ->first();
                $gamersToAdd[] = $row;
            }
            $model->gamers[$item->name] = $gamersToAdd;
        }

        $model->greater = [];
        $model->bellow = [];
        foreach ($rating as $item) {
            if ($item->total_value > 5) $model->greater[] = $item;
            else $model->bellow[] = $item;
        }

        return view('front.rating.team', [ 'model' => $model]);
    }
    #endregion

    public function revealPresentation(){
        return view('front.reveal');
    }
}
