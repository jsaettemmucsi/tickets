<?php

namespace App\Http\Controllers;

use App\Models\BS;
use App\Models\CI;
use App\Models\Team;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Worknote;
use Illuminate\Http\Request;

class TicketController extends Controller
{
	public function index()
	{
		$tickets = Ticket::where('active', true)->get();
		return view('tickets/index', compact('tickets'));
	}


	public function create()
	{
		$ticket = new Ticket();
		$ticket->opened = now();
		$ticket->requester = auth()->user()->id;
		$ticket->channel = "Direct input";
		$ticket->status = "New";
		$ticket->impact = "4 - Minor/Localized";
		$ticket->urgency = "4 - Low";
		$ticket->priority = "Low (P4)";
		$ticket->active = false;
		$ticket->save();
		$ticket->fresh();
		return redirect($ticket->link());
	}


	public function show(Ticket $ticket)
	{
		$bss = BS::all();
		$cis = CI::all();
		$teams = Team::with('users')->get();
		$users = User::all();
		return view('tickets/show', compact('ticket', 'bss', 'cis', 'teams', 'users'));
	}


	public function update(Ticket $ticket, Request $request)
	{
		$ticket->channel = $request->channel;
		$ticket->active = $request->active;
		$ticket->status = $request->status;
		$ticket->requester = $request->requester;
		$ticket->impact = $request->impact;
		$ticket->category = $request->category;
		$ticket->subcategory = $request->subcategory;
		$ticket->urgency = $request->urgency;
		$ticket->priority = $request->priority;
		$ticket->businessservice_id = $request->businessservice_id;
		$ticket->configurationitem_id = $request->configurationitem_id;
		$ticket->owner_group = $request->owner_group;
		$ticket->assignment_group = $request->assignment_group;
		$ticket->assigned_to = $request->assigned_to;
		$ticket->short_description = $request->short_description;
		$ticket->description = $request->description;
		
		// get dirty values
		$dirt = $ticket->getDirty();

		// loop through dirt and log em
		if ($dirt) {
			$newdirt = [];
			foreach($dirt as $key => $dir) {
				$newdirt[] = [$key, $dir, $ticket->getOriginal($key)];
			}

			// dd($ticket);
			$this->log($ticket->id, $newdirt);
		}


		$ticket->save();

		// Did we have a addl comments and/or work notes specified as well?
		if (isset($request['addl-comments'])) {
			if ($request['addl-comments'] != "") {
				$ac = new Worknote();
				$ac->internal = false;
				$ac->ticket_id = $ticket->id;
				$ac->user_id = auth()->user()->id;
				$ac->type = "Additional comments";
				$ac->body = $request['addl-comments'];
				$ac->save();
			}
		}

		if (isset($request['work-notes'])) {
			if ($request['work-notes'] != "") {
				$ac = new Worknote();
				$ac->internal = true;
				$ac->ticket_id = $ticket->id;
				$ac->user_id = auth()->user()->id;
				$ac->body = $request['work-notes'];
				$ac->type = "Work notes (only visible to IT)";
				$ac->save();
			}
		}

		if (isset($request['mermaid-in'])) {
			if ($request['mermaid-in'] != "") {
				$ac = new Worknote();
				$ac->internal = true;
				$ac->ticket_id = $ticket->id;
				$ac->user_id = auth()->user()->id;
				$ac->body = $request['mermaid-in'];
				$ac->type = "Diagram";
				$ac->save();
			}
		}

		return redirect($ticket->link());
	}

	public function log($ticket_id, $data)
	{
		$wn = new Worknote();
		$wn->user_id = auth()->user()->id;
		$wn->ticket_id = $ticket_id;
		$wn->data = $data;
		$wn->type = "Field changes";
		$wn->internal = 0;
		$wn->save();
	}

	public function isJson($string) {
		json_decode($string);
		return json_last_error() === JSON_ERROR_NONE;
	 }

}
