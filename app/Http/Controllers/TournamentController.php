<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TournamentController extends Controller
{
    #region CRUD
    public function index()
    {
        $instances = Tournament::all();
        return view('admin.tournaments.index', [
            "instances" => $instances,
        ]);
    }

    public function create()
    {
        $participants = Team::asSelectableOptionArray();
        // TODO Убрать. Тест
        $currentParticipants = [Team::find(1)];
        return view('admin.tournaments.create', ['participants' => $participants, 'currentParticipants' => $currentParticipants]);
    }

    public function store(Request $request)
    {
        $input = Input::all();
        echo "<pre>".var_export($input, true);
        die();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
    #endregion
}
