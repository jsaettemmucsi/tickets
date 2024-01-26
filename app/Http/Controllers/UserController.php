<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Team;
use App\Models\Site;
use Illuminate\Http\Request;

class UserController extends Controller
{


	public function index()
	{
		$users = User::all();
		return view('users/index', compact('users'));
	}


	public function create()
	{
		$user = new User();
		$user->name = "New user";
		$user->email = "user@sagikos.com";
		$user->password = "xxx";
		$user->save();
		return redirect('/users');
	}


	public function show(User $user) {
		$sites = Site::all();
		return view('users/show', compact('user', 'sites'));
	}


	public function update(Request $request, User $user) {
		$user->name = $request->name;
		$user->email = $request->email;
		$user->default_team = $request->default_team;
		$user->site_id = $request->site_id;
		$user->picture_url = $request->picture_url;
		$user->save();
		return redirect('/users');
	}


	public function editTeams(User $user)
	{
		$teams = Team::all();
		return view('users/teams', compact('user', 'teams'));
	}


	public function updateTeams(User $user, Request $request)
	{
		$user->teams()->detach();
		$user->teams()->attach($request->teams_selected);
		return redirect($user->link());
	}
}
