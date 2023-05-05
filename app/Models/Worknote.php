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
}
