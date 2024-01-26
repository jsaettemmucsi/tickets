<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Team;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    function index() {
        $sites = Site::all();
        return view('sites/index', compact('sites'));
    }


    function create() {
        $site = new Site();
        $site->name = "New site";
        $site->save();
        return redirect()->back();
    }


    function show(Site $site) {
        $teams = Team::all();
        return view('sites/show', compact('site', 'teams'));
    }


    function update(Site $site, Request $request) {
        $site->name = $request->name;
        $site->team_id = $request->team_id;
        $site->description = $request->description;
        $site->save();
        return redirect('/sites');
    }
}
