<?php

namespace App\Http\Controllers;

use App\Models\TeamCreateRequest;
use App\Traits\TeamConstructor;
use Illuminate\Http\Request;

class TeamCreateRequestController extends Controller
{
    use TeamConstructor;

    public function index(Request $request)
    {
        $instances = TeamCreateRequest::all();

        $instances = $instances->where('deleted_at', '=', null);
        return view('admin.teamRequests.index', [
            "instances" => $instances,
        ]);
    }


    public function create()
    {
        //
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
}
