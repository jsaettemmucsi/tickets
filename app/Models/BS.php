<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BS extends Model
{
    use HasFactory;

	public function link()
	{
		return "/bs/{$this->id}";
	}
}
