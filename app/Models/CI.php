<?php

namespace App\Models;

use App\Models\BS;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CI extends Model
{
    use HasFactory;

	public function bs()
	{
		return $this->belongsTo(BS::class);
	}

	public function link()
	{
		return "/ci/{$this->id}";
	}
}
