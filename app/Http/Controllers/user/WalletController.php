<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * @param Request $request
     * @return
     */
    public function add(Request $request)
    {
        $request->validate(['wallet'=>'numeric|min:0']);
        $user = auth()->user();
        $user->wallet += $request->wallet;
        $user->save();
        return response(['msg'=>"Your add {$request->wallet} to your wallet. Your current wallet is: {$user->wallet}"]);
    }

    public function show()
    {
        $wallet = auth()->user()->wallet;
        return response(['msg'=>"you have {$wallet} in your wallet"]);
    }
}
