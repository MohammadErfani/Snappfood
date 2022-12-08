<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $comments = Auth::guard('salesman')->user()->restaurant->comments;
        return view('restaurant.comment.comments',compact('comments'));
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */

    public function accept(Comment $comment)
    {
        $comment->status = Comment::ACCEPTED;
        $comment->save();
        return redirect()->route('restaurant.comment.index');
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Comment $comment)
    {
        $comment->status = Comment::DELETEREQUEST;
        $comment->save();
        return redirect()->route('restaurant.comment.index');
    }

    /**
     * @param Request $request
     * @param Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function answer(Request $request,Comment $comment)
    {
        $comment->answer = $request->answer;
        $comment->save();
        return redirect()->route('restaurant.comment.index');
    }


}
