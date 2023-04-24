<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class View extends Model
{
    use HasFactory;

	public function link()
	{
		return '/views/' . $this->id;
	}

	public function columns()
	{
		$array = explode(",", $this->columns);
		$array2 = [];
		foreach($array as $value) {
			if ($value == "identifier()") { 
				$value = "id";
			}
			$array2[] = trim($value);
		}
		return $array2;
	}


	public function tickets()
	{
		if ($this->filter) {
			return Ticket::select($this->columns())->whereRaw($this->filter)->get();
		}
		else {
			return Ticket::select($this->columns())->get();
		}
	}

	
	public static function displayColumn($column)
	{
		switch($column) {
			case 'id':
				return 'Incident';
			case 'updated_at':
				return 'Updated';
			case 'created_at':
				return 'Opened';
		}
		return Str::headline($column);
	}

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
