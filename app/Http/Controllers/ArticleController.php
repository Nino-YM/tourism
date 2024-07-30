<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        return Article::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'article_name' => 'required|string|max:50',
            'article_content' => 'required|string',
            'published_date' => 'required|date',
            'id_user' => 'required|exists:users,id_user'
        ]);

        $article = Article::create([
            'article_name' => $request->article_name,
            'article_content' => $request->article_content,
            'published_date' => $request->published_date,
            'id_user' => $request->id_user
        ]);

        return response()->json($article, 201);
    }

    public function show($id)
    {
        return Article::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'article_name' => 'string|max:50',
            'article_content' => 'string',
            'published_date' => 'date',
            'id_user' => 'exists:users,id_user'
        ]);

        $article = Article::findOrFail($id);

        if ($request->has('article_name')) {
            $article->article_name = $request->article_name;
        }
        if ($request->has('article_content')) {
            $article->article_content = $request->article_content;
        }
        if ($request->has('published_date')) {
            $article->published_date = $request->published_date;
        }
        if ($request->has('id_user')) {
            $article->id_user = $request->id_user;
        }

        $article->save();

        return response()->json($article, 200);
    }

    public function destroy($id)
    {
        Article::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
