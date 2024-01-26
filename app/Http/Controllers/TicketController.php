<?php

namespace App\Http\Controllers;

use App\Models\BS;
use App\Models\CI;
use App\Models\View;
use App\Models\Team;
use App\Models\User;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Worknote;
use App\Models\HoldReason;
use Illuminate\Http\Request;

class TicketController extends Controller
{

	public function index()
	{

		// Check if we have a default view
		$this->createViews();

		$views = View::select('id', 'name');

		// if user has a selected view, view that.
		if (auth()->user()->view > 0) {
			return redirect('/views/' . auth()->user()->view);
		}

		// Otherwise, go to the first available view.
		return redirect($views[0]->link());
	}


	public function create()
	{
		$ticket = new Ticket();
		$ticket->opened = now();
		$ticket->requester = auth()->user()->id;
		$ticket->channel = "Direct input";
		$ticket->status = 1;
		$ticket->impact = 4;
		$ticket->urgency = 4;
		$ticket->priority = "Low (P4)";
		$ticket->active = false;
		$ticket->save();
		$ticket->fresh();
		return redirect($ticket->link());
	}


	public function show(Ticket $ticket)
	{
		if (!$ticket->active) {
			// return redirect('/tickets');
		}
		$this->createViews();
		$bss = BS::all();
		$cis = CI::all();
		$teams = Team::with('users')->get();
		$users = User::all();
		$views = View::all();
		$statuses = Status::all();
		$holdReasons = HoldReason::all();
		return view('tickets/show', compact('ticket', 'bss', 'cis', 'teams', 'users', 'views', 'statuses', 'holdReasons'));
	}


	public function update(Ticket $ticket, Request $request)
	{
		$this->upd($ticket, $request);
		if(auth()->user()->view > 0) {
			return redirect('/views/' . auth()->user()->view);
		}
		return redirect('/tickets');
	}


	public function save(Ticket $ticket, Request $request)
	{
		$this->upd($ticket, $request);
		return redirect($ticket->link());
	}

	public function savepost(Ticket $ticket, Request $request)
	{
		$this->upd($ticket, $request);
		// return redirect($ticket->link());
		return redirect($ticket->link() . '/#sep-bar');
	}

	public function upd(Ticket $ticket, Request $request)
	{
		$ticket->channel = $request->channel;
		$ticket->active = $request->active;
		$ticket->status_id = $request->status_id;
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
				$newdirt[] = [$key, Worknote::getname($key, $dir), Worknote::getname($key, $ticket->getOriginal($key))];
			}

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

				if ($request['tagged-users'] != null) {
					$taggedUsers = json_decode($request['tagged-users']);
					foreach($taggedUsers as $taggedUser) {
						$taggedUserID = substr($taggedUser, 5);
						User::findOrFail($taggedUserID)->notify(auth()->user()->name . " mentioned you in " . $ticket->identifier(), "Click here for details");
					}
				}

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


	 public function view(View $view)
	 {
		$this->createViews();
		$views = View::select('id', 'name', 'columns')->get();

		// make the viewed view the set view
		$user = auth()->user();
		$user->view = $view->id;
		$user->save();
		return view('views/view', compact('view', 'views'));
	 }


	 public function createViews()
	 {
		if (View::count() == 0) {

			// If not, create one.
			$view = new View();
			$view->public = true;
			$view->created_by = auth()->user->id;
			$view->updated_by = auth()->user->id;
			$view->columns = "identifier(), status_id, priority, assignment_group, assigned_to, short_description, updated_at, created_at";
			$view->sorted_by = "updated_at";
			$view->grouped_by = null;
			$view->name = "All Incidents";
			$view->filter = "active = 1";
			$view->save();

			$view = new View();
			$view->public = true;
			$view->created_by = auth()->user()->id;
			$view->updated_by = auth()->user()->id;
			$view->columns = "identifier(), status_id, priority, assignment_group, assigned_to, short_description, updated_at, created_at";
			$view->sorted_by = "updated_at";
			$view->grouped_by = null;
			$view->name = "Open incidents";
			$view->filter = "status_id in (1, 2, 3) AND active = 1";
			$view->save();

			$view = new View();
			$view->public = true;
			$view->created_by = auth()->user()->id;
			$view->updated_by = auth()->user()->id;
			$view->columns = "identifier(), status_id, priority, assignment_group, assigned_to, short_description, updated_at, created_at";
			$view->sorted_by = "updated_at";
			$view->grouped_by = null;
			$view->name = "In Progress";
			$view->filter = "status_id = 2 AND active = 1";
			$view->save();

			$view = new View();
			$view->public = true;
			$view->created_by = auth()->user()->id;
			$view->updated_by = auth()->user()->id;
			$view->columns = "identifier(), status_id, priority, assignment_group, assigned_to, short_description, updated_at, created_at";
			$view->sorted_by = "updated_at";
			$view->grouped_by = null;
			$view->name = "New";
			$view->filter = "status_id = 1 AND active = 1";
			$view->save();

			$view = new View();
			$view->public = true;
			$view->created_by = auth()->user()->id;
			$view->updated_by = auth()->user()->id;
			$view->columns = "identifier(), status_id, priority, assignment_group, assigned_to, short_description, updated_at, created_at";
			$view->sorted_by = "updated_at";
			$view->grouped_by = null;
			$view->name = "On hold";
			$view->filter = "status_id = 3 AND active = 1";
			$view->save();

		}

	 }


	 public function onhold(Ticket $ticket, Request $request)
	 {
		 // check if an addl comment has been supplied, otherwise route back with error.
		if (!$request['addl-comments']) {
			return redirect()->back()->withErrors(['msg' => 'Additional comments required to put incident on hold.']);
		}

		$oldstatus = $ticket->status;
		$this->upd($ticket, $request);
		$ticket->status_id = 3;
		$ticket->save();
		$this->log($ticket->id, [['status_id', 'On hold', $oldstatus?->name]]);
		return redirect('/views/' . auth()->user()->view);
	 }

	 public function resolve(Ticket $ticket, Request $request)
	 {
		 // check if an addl comment has been supplied, otherwise route back with error.
		if (!$request['addl-comments']) {
			return redirect()->back()->withErrors(['msg' => 'Additional comments required to resolve an incident.']);
		}

		$oldstatus = $ticket->status;
		$this->upd($ticket, $request);
		$ticket->status_id = 4;
		$ticket->save();
		$this->log($ticket->id, [['status_id', 'Resolved', $oldstatus?->name]]);
		return redirect('/views/' . auth()->user()->view);

	 }

	 public function resume(Ticket $ticket, Request $request)
	 {
		 // check if an addl comment has been supplied, otherwise route back with error.
		$oldstatus = $ticket->status;
		$this->upd($ticket, $request);
		$ticket->status_id = 2;
		$ticket->save();
		$this->log($ticket->id, [['status_id', 'In progress', $oldstatus?->name]]);
		return redirect()->back();

	 }






}
