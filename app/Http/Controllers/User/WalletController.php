<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $request->validate(['wallet'=>'numeric|min:0']);
        $user = auth()->user();
        $user->wallet += $request->wallet;
        $user->save();
        return response(['msg'=>"Your add {$request->wallet} to your wallet. Your current wallet is: {$user->wallet}"]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function show()
    {
        $wallet = auth()->user()->wallet;
        return response(['msg'=>"you have {$wallet} in your wallet"]);
    }
}
