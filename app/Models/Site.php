<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;


    function users() {
        return $this->hasMany(User::class);
    }

    function team() {
        return $this->belongsTo(Team::class);
    }


    function link() {
        return '/sites/' . $this->id;
    }
}
