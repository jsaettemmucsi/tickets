<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

	protected static function boot()
	{
		parent::boot();
	
		static::addGlobalScope('order', function (Builder $builder) {
			$builder->orderBy('name', 'asc');
		});
	}


	public function link()
	{
		return "/teams/{$this->id}";
	}

	public function users()
	{
		return $this->belongsToMany(User::class);
	}

	public function owner()
	{
		return $this->belongsTo(User::class, 'owner_id');
	}

	public static function active()
	{
		return static::where('active', true)->get();
	}


	public function sites() {
		return $this->hasMany(Site::class);
	}
}
