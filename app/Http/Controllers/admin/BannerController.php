<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\admin\Banner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin.banner.banners', ['banners' => Banner::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.banner.createBanner');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BannerRequest $request
     * @return RedirectResponse
     */
    public function store(BannerRequest $request)
    {
        $request->validate(['picture'=>'required']);
        $picturePath = $request->file('picture')->store('uploads/banners');
        Banner::create([
            'title' => $request->title,
            'picture' => $picturePath
        ]);
        return redirect()->route('admin.banner.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\admin\Banner $banner
     * @return View
     */
    public function edit(Banner $banner)
    {
        return view('admin.banner.editBanner', [
            'banner' => $banner
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BannerRequest $request
     * @param \App\Models\admin\Banner $banner
     * @return RedirectResponse
     */
    public function update(BannerRequest $request, Banner $banner)
    {
        if ($request->file('picture') !== null) {
            Storage::delete($banner->picture);
            $picturePath = $request->file('picture')->store('uploads/banners');
        }else{
            $picturePath = $banner->picture;
        }
        $banner->update([
            'title' => $request->title,
            'picture' => $picturePath
        ]);
        return redirect()->route('admin.banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\admin\Banner $banner
     * @return RedirectResponse
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('admin.banner.index');
    }
}
