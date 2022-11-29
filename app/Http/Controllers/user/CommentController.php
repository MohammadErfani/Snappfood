<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\restaurant\Food;
use App\Models\restaurant\Restaurant;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(CommentRequest $request)
    {
        Comment::create([
            'order_id' => $request->cart_id,
            'score' => $request->score,
            'content' => $request->message,
            'status' => Comment::ADDED
        ]);
        return response(['msg' => "Comment created successfully"]);
    }

    public function foodComments(Request $request)
    {
        $request->validate(['restaurant_id' => 'numeric', 'food_id' => 'numeric']);
        if (isset($request->food_id)) {
            $comments = Food::find($request->food_id)->comments;
        } elseif(isset($request->restaurant_id)) {
            $comments = Restaurant::find($request->restaurant_id)->comments;
        }else{
            return response(['msg'=>"set food or restaurant_id to show comments"]);
        }
        return CommentResource::collection($comments);
    }

}
