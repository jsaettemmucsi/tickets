<?php

namespace App\Models;

use App\Models\BS;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CI extends Model
{
    use HasFactory;

	protected static function boot()
	{
		parent::boot();
	
		static::addGlobalScope('order', function (Builder $builder) {
			$builder->orderBy('name', 'asc');
		});
	}

	public function bs()
	{
		return $this->belongsTo(BS::class);
	}

	public function link()
	{
		return "/ci/{$this->id}";
	}
}
