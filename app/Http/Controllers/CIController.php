<?php

namespace App\Http\Controllers;

use App\Models\CI;
use App\Models\BS;
use App\Models\Team;
use Illuminate\Http\Request;

class CIController extends Controller
{


	public function index()
	{
		$cis = CI::all();
		return view('ci/index', compact('cis'));
	}


	public function create()
	{
		$ci = new CI();
		$ci->name = "New ci";
		$ci->bs_id = 1;
		$ci->save();
		return redirect('/ci');
	}


	public function show(CI $ci) {
		$bss = BS::all();
		$teams = Team::all();
		return view('ci/show', compact('ci', 'bss', 'teams'));
	}


	public function update(Request $request, CI $ci) {
		$ci->url = $request->url;
		$ci->name = $request->name;
		$ci->bs_id = $request->bs_id;
		$ci->vendor = $request->vendor;
		$ci->support_team_id = $request->support_team_id;

		$ci->save();
		return redirect('/ci');
	}


}
