<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Ticket extends Model
{
    use HasFactory;

	const PREFIX = 'INC';

	protected static function boot()
	{
		parent::boot();
	
		static::addGlobalScope('order', function (Builder $builder) {
			$builder->orderBy('created_at', 'desc');
		});
	}

	public function link() {
		return "/tickets/{$this->id}";
	}


	public function identifier()
	{
		return Ticket::PREFIX . Str::padLeft($this->id, 5, '0');
	}


	public function requested_by()
	{
		return $this->belongsTo(User::class, 'requester');
	}


	public function bs()
	{
		return $this->belongsTo(BS::class, 'businessservice_id');
	}


	public function ci()
	{
		return $this->belongsTo(CI::class, 'configurationitem_id');
	}


	public function assigned_group()
	{
		return $this->belongsTo(Team::class, 'assignment_group');
	}


	public function owned_group()
	{
		return $this->belongsTo(Team::class, 'owner_group');
	}

	public function assigned()
	{
		return $this->belongsTo(User::class, 'assigned_to');
	}


	public function prioritybox()
	{
		$bg = "";
		// if ($this->priority == "Critical (P1)") { 
		// 	$bg = "bg-red-600 text-white";
		// }
		// else if ($this->priority == "High (P2)") { 
		// 	$bg = "bg-amber-600 text-white";
		// }
		// else if ($this->priority == "Medium (P3)") { 
		// 	// $bg = "bg-green-600 text-white";
		// }

		return '<span class="block ' . $bg . ' px-4 py-3">' . $this->priority . '</span>';
	}


	public function worknotes()
	{
		return $this->hasMany(Worknote::class);
	}

	public function addlComments()
	{
		return $this->worknotes->filter(['internal' => 0]);
	}


	public function short_description()
	{
		return Article::mark($this->short_description);
	}
	

	public function showColumn($column)
	{
		switch($column) {
			case 'id':
				return view('components.views-id', ['ticket' => $this]);
			case 'assignment_group':
				return view('components.views-assignmentgroup', ['ticket' => $this]);
			case 'assigned_to':
				return view('components.views-assignedto', ['ticket' => $this]);
			case 'updated_at':
				return view('components.views-updatedat', ['ticket' => $this]);
			case 'created_at':
				return view('components.views-createdat', ['ticket' => $this]);
			case 'status':
				return view('components.views-status', ['ticket' => $this]);
			case 'priority':
				return view('components.views-prio', ['ticket' => $this]);
		}
		return $this->$column;
	}

}
