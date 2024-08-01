<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

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
        ]);

        $article = Article::create([
            'article_name' => $request->article_name,
            'article_content' => $request->article_content,
            'published_date' => $request->published_date,
            'id_user' => Auth::id()
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
            'published_date' => 'date'
        ]);

        $article = Article::findOrFail($id);


        if ($article->id_user != Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($request->has('article_name')) {
            $article->article_name = $request->article_name;
        }
        if ($request->has('article_content')) {
            $article->article_content = $request->article_content;
        }
        if ($request->has('published_date')) {
            $article->published_date = $request->published_date;
        }

        $article->save();

        return response()->json($article, 200);
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if ($article->id_user != Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $article->delete();

        return response()->json(null, 204);
    }
}
