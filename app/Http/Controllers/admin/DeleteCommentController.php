<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class DeleteCommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all()->where('status',Comment::DELETEREQUEST);
        return view('admin.deleteComment',compact('comments'));
    }

    public function delete(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comment.index');
    }
    public function accept(Comment $comment)
    {
        $comment->status=Comment::ACCEPTED;
        $comment->save();
        return redirect()->route('admin.comment.index');
    }

}
