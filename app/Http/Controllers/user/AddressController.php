<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use function auth;
use function response;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = auth()->user()->addresses;
        return $addresses->isNotEmpty() ? $addresses:["msg"=>"you don't add any address"];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AddressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request)
    {
        $address = auth()->user()->addresses()->save(new Address($request->all()));
        $this->setCurrent($address);
        return response(['msg'=>'Address added Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        return response($address,200);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  AddressRequest  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, Address $address)
    {
        $address->update($request->all());
        return response(['msg'=>'Address updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address->delete();
        return response(['msg'=>'Address Deleted']);
    }

    public function setCurrent(Address $address)
    {
        auth()->user()->addresses()->where('is_current',1)->update(['is_current'=>null]);
        $address->update(['is_current'=>true]);
        return response(["your current address set ".$address->title]);
    }
}
