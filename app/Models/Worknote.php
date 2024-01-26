<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Worknote extends Model
{
    use HasFactory;

	protected $casts = [
		'data' => 'array',
	];

	protected $touches = ['ticket'];


	
	protected static function boot()
	{
		parent::boot();
	
		static::addGlobalScope('order', function (Builder $builder) {
			$builder->orderBy('created_at', 'desc');
		});
	}



	public function user()
	{
		return $this->belongsTo(User::class);
	}


	
	public function body()
	{
		if ($this->body != "") {
			return Article::mark($this->body);
		}
	}



	public function ticket()
	{
		return $this->belongsTo(Ticket::class);
	}



	public static function getname($key, $value) {
		if ($value == null) { return; }
		switch($key) {
			case 'businessservice_id':
				return BS::find($value)?->name;
			case 'configurationitem_id':
				return CI::find($value)?->name;
			case 'assignment_group':
			case 'owner_group':
				return Team::find($value)?->name;
			case 'assigned_to':
				return User::find($value)?->name;
			case 'active':
				if ($value == 1) { return 'true'; }
				return 'false';
			case 'status_id':
				return Status::find($value)?->name;

		}
		return $value;
	}
}
