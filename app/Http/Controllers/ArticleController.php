<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use GrahamCampbell\Markdown\Facades\Markdown;

class ArticleController extends Controller
{
    public function index()
	{
		$articles = Article::all();
		return view('articles/index', compact('articles'));
	}

	public function show($article)
	{

		$article = Article::firstOrNew(
			['title' => $article],
			['user_id' => auth()->user()->id]
		);

		if (!$article->user_id) {
			$article->user_id = auth()->user()->id;
			$article->body = "Empty article";
			$article->save();
		}

		return view('articles/show', compact('article'));
	}


	public function update(Request $request)
	{
		$article = Article::find($request->params['id']);
		$article->body = $request->params['body'];
		$article->save();
		return response()->json('good');
	}


	public function md(Request $request)
	{
		return Article::mark($request->params['body']);

	}

}
