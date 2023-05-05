<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;


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

	public function title()
	{
		return Article::mark($this->title);
	}



	public function body()
	{
		return Article::mark($this->body);
	}
}
