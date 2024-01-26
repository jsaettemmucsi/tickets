<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

	protected static function boot()
	{
		parent::boot();
	
		static::addGlobalScope('order', function (Builder $builder) {
			$builder->orderBy('name', 'asc');
		});
	}

    

	public function link()
	{
		return "/users/{$this->id}";
	}


	public function teams()
	{
		return $this->belongsToMany(Team::class);
	}


	public function tickets()
	{
		return $this->hasMany(Ticket::class);
	}

	public function view()
	{
		return $this->belongsTo(View::class);
	}


	public function notifications()
	{
		return $this->hasMany(Notification::class);
	}


	public function notify($title, $body) 
	{
		$notification = new Notification();
		$notification->title = $title;
		$notification->body = $body;
		$notification->user_id = $this->id;
		$notification->save();
	}


	public function site() {
		return $this->belongsTo(Site::class);
	}
}
