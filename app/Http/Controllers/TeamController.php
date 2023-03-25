<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
	public function index()
	{
		$teams = Team::all();
		return view('teams/index', compact('teams'));
	}


	public function create()
	{
		$team = new Team();
		$team->name = "New team";
		$team->description = "";
		$team->email = "";
		$team->save();
		return redirect('/teams');
	}

	public function show(Team $team) {
		return view('teams/show', compact('team'));
	}

	public function update(Request $request, Team $team) {
		$team->name = $request->name;
		$team->description = $request->description;
		$team->email = $request->email;

		$team->save();
		return redirect('/teams');
	}
}
