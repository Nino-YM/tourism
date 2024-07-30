<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment_content' => 'required|string',
            'comment_date' => 'required|date',
            'id_article' => 'required|exists:articles,id_article',
            'id_user' => 'required|exists:users,id_user'
        ]);

        $comment = Comment::create([
            'comment_content' => $request->comment_content,
            'comment_date' => $request->comment_date,
            'id_article' => $request->id_article,
            'id_user' => $request->id_user
        ]);

        return response()->json($comment, 201);
    }

    public function show($id)
    {
        return Comment::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'comment_content' => 'string',
            'comment_date' => 'date',
            'id_article' => 'exists:articles,id_article',
            'id_user' => 'exists:users,id_user'
        ]);

        $comment = Comment::findOrFail($id);

        if ($request->has('comment_content')) {
            $comment->comment_content = $request->comment_content;
        }
        if ($request->has('comment_date')) {
            $comment->comment_date = $request->comment_date;
        }
        if ($request->has('id_article')) {
            $comment->id_article = $request->id_article;
        }
        if ($request->has('id_user')) {
            $comment->id_user = $request->id_user;
        }

        $comment->save();

        return response()->json($comment, 200);
    }

    public function destroy($id)
    {
        Comment::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
