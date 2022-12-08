<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class DeleteCommentController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $comments = Comment::all()->where('status',Comment::DELETEREQUEST);
        return view('admin.deleteComment',compact('comments'));
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comment.index');
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function accept(Comment $comment)
    {
        $comment->status=Comment::ACCEPTED;
        $comment->save();
        return redirect()->route('admin.comment.index');
    }

}
