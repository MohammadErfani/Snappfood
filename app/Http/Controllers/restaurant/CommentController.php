<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Auth::guard('salesman')->user()->restaurant->comments;
        return view('restaurant.comment.comments',compact('comments'));
    }


    public function accept(Comment $comment)
    {
        $comment->status = Comment::ACCEPTED;
        $comment->save();
        return redirect()->route('restaurant.comment.index');
    }

    public function delete(Comment $comment)
    {
        $comment->status = Comment::DELETEREQUEST;
        $comment->save();
        return redirect()->route('restaurant.comment.index');
    }

    public function answer(Request $request,Comment $comment)
    {
        $comment->answer = $request->answer;
        $comment->save();
        return redirect()->route('restaurant.comment.index');
    }


}
