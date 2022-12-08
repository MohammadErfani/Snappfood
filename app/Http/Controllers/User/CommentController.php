<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\UserCommentResource;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Restaurant\Food;
use App\Models\Restaurant\Restaurant;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @param CommentRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
       if(Order::find($request->cart_id)->user->id!==auth()->user()->id){
           return response(['msg'=>"This cart doesn't belongs to you"]);
       }
        Comment::create([
            'order_id' => $request->cart_id,
            'score' => $request->score,
            'content' => $request->message,
            'status' => Comment::ADDED
        ]);
        return response(['msg' => "Comment created successfully"]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\Response
     */
    public function foodComments(Request $request)
    {
        $request->validate(['restaurant_id' => 'numeric', 'food_id' => 'numeric']);
        if (isset($request->food_id)) {
            $comments = Food::find($request->food_id)->comments->where('status',Comment::ACCEPTED);
        } elseif(isset($request->restaurant_id)) {
            $comments = Restaurant::find($request->restaurant_id)->comments->where('status',Comment::ACCEPTED);
        }else{
            return response(['msg'=>"set food or restaurant_id to show comments"]);
        }
        return CommentResource::collection($comments);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     *
     */
    public function showUserComments()
    {
        $comments = auth()->user()->comments;
        return UserCommentResource::collection($comments);
    }
}
