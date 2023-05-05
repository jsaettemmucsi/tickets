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
		// If we don't have a default sort order, set it to id.
		if ($this->sorted_by == null) {
			$this->sorted_by = 'id';
		}

		if ($this->filter) {
			if ($this->grouped_by) {
				return Ticket::select($this->columns())->whereRaw($this->filter)->orderBy($this->sorted_by, 'desc')->groupBy('grouped_by')->get();
			}
			else {
				return Ticket::select($this->columns())->whereRaw($this->filter)->orderBy($this->sorted_by, 'desc')->get();

			}
		}
		else {
			return Ticket::select($this->columns())->orderBy($this->sorted_by, 'desc')->get();
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
