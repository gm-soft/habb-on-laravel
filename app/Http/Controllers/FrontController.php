<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Models\Post;
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


        return $this->View('front.posts.show', ["post" => $post]);
    }

    public function showAllPosts() {
        $posts = Post::all();
        foreach ($posts as $post) {
            $post->decodeHtmlContent();
        }
        return $this->View('front.posts.index', ["posts" => $posts]);
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

        return view('front.rating.gamer', [
            'game' => $game,
            'rating' => $rating,
            'greater' => $graterPoint,
            'bellow' => $bellowTheLine
        ]);
    }

    public function teamRating($game = Constants::CsGo){
        $rating = \DB::table('teams')
            ->join('team_scores', 'teams.id', '=', 'team_scores.team_id')
            ->where('team_scores.game_name', '=', $game)
            ->where('team_scores.total_value', '>', 0)
            ->orderBy('team_scores.total_value', 'desc')
            ->get();

        $gamers = [];

        foreach ($rating as $item) {
            $gamerIds = explode(', ', $item->gamer_ids);
            $gamerRoles = explode(', ', $item->gamer_roles);
            $gamersToAdd = [];

            for($i = 0; $i < count($gamerIds); $i++) {
                $id = $gamerIds[$i];
                $role = $gamerRoles[$i];

                if ($role == 'coach' || $role == 'reserve') continue;

                $gamersToAdd[] = \DB::table('gamers')->select('gamers.id', 'name', 'last_name', 'city', 'gamer_scores.total_value', 'gamer_scores.total_change')
                    ->where('gamers.id', '=', $id)
                    ->join('gamer_scores', 'gamers.id', '=', 'gamer_scores.gamer_id')
                    ->where('gamer_scores.game_name', '=', $game)
                    ->get();
            }
            $gamers[$item->name] = $gamersToAdd;
        }

        return view('front.rating.team', ['rating' => $rating, 'gamers' => $gamers]);
    }
    #endregion
}
