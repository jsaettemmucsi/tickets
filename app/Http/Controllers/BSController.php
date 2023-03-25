<?php

namespace App\Http\Controllers;

use App\Models\BS;
use Illuminate\Http\Request;

class BSController extends Controller
{
	public function index()
	{
		$bss = BS::all();
		return view('bs/index', compact('bss'));
	}


	public function create()
	{
		$bs = new BS();
		$bs->name = "New bs";
		$bs->save();
		return redirect('/bs');
	}

	public function show(BS $bs) {
		return view('bs/show', compact('bs'));
	}

	public function update(Request $request, BS $bs) {
		$bs->name = $request->name;
		$bs->save();
		return redirect('/bs');
	}
}
