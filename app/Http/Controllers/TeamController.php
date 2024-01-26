<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
	public function index()
	{
		$teams = Team::active();
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
		$team->logo = $request->logo;
		$team->logourl = $request->logourl;
		$team->save();
		return redirect('/teams');
	}


	public function delete(Team $team)
	{
		// check if team is active first, if not take no action.
		if (!$team->active) { return redirect()->back(); }

		// check if user is owner of team or a global admin
			// 1. does the team have an owner
			if ($team->owner) {

				// 2. does the owner match the logged in user?
				if ($team->owner->id == auth()->user()->id) {
					$team->active = false;
					$team->save();
				}
			}

		return redirect('/teams');
	}
}
