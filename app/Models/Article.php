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
		if ($text) {
			$text = Markdown::convert($text)->getContent();
			$text = preg_replace('/({{) (\w+) (}})/', '<a href="/kb/$2">$2</a>', $text);
			$text = preg_replace('/(INC)(\w+)/', '<a href="/tickets/$2">INC$2</a>', $text);
			$text = str_replace('<code class="language-mermaid">', '<code class="mermaid">', $text);
			return $text;
		}
		return;
	}

	public function md()
	{
		$md = Article::mark($this->body);
		return $md;
	}


	public function headline()
	{
		return Str::headline($this->title);
	}

}
