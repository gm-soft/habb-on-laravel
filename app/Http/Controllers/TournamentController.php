<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;

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
        return view('admin.tournaments.create', ['participants' => $participants]);
    }

    public function store(Request $request)
    {
        //
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
