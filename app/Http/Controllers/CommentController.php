<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::orderBy('id', 'asc')->get();
        return view('comment', [
            'comments' => $comments
        ]);
    }

    public function create(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|max:30',
//        ]);
//
//        if ($validator->fails()) {
//            return redirect('/food')
//                ->withInput()
//                ->withErrors($validator);
//        }

        //var_dump($request);
        $comment = new Comment;
        $comment->user_name = $request->from;
        $comment->comment = $request->message;
        $comment->save();

        return redirect('/comments')->with('alert', "Отзыв " . $comment->user_name . " добавлен.");
    }
}
