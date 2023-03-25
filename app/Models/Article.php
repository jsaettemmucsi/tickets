<?php

namespace App\Models;

use GrahamCampbell\Markdown\Facades\Markdown;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Article extends Model
{
    use HasFactory;
	protected $fillable = ['title'];
	const PREFIX = 'KB';


	public function link()
	{
		return '/kb/' . $this->title;
	}
	public function adminlink()
	{
		return '/article/' . $this->id;
	}

	public function author()
	{
		return $this->belongsTo(User::class, 'user_id');
	}


	public function identifier()
	{
		return Article::PREFIX . Str::padLeft($this->id, 4, '0');
	}


	public static function mark($text)
	{
		$text = Markdown::convert($text)->getContent();
		$text = preg_replace('/({{) (\w+) (}})/', '<a href="/kb/$2">$2</a>', $text);

		return $text;
	}

	public function md()
	{
		return Article::mark($this->body);
	}


	public function headline()
	{
		return Str::headline($this->title);
	}

}
