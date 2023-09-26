<?php

namespace App\Http\Controllers;

use App\Models\CommunityService;
use Illuminate\Http\Request;

class CommunityServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $community_service = CommunityService::get();
        return view('community_service.index',[
            'community_service' => $community_service
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('community_service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $community_service = new CommunityService;
        $community_service->fullname = $request->fullname;
        $community_service->contact = $request->contact;
        $community_service->email = $request->email;
        $community_service->organization = $request->organization;
        $community_service->message = $request->message;
        $community_service->save();

        return redirect()->back()->withStatus("Successfully added");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommunityService  $communityService
     * @return \Illuminate\Http\Response
     */
    public function show(CommunityService $communityService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommunityService  $communityService
     * @return \Illuminate\Http\Response
     */
    public function edit(CommunityService $communityService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommunityService  $communityService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommunityService $communityService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommunityService  $communityService
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommunityService $communityService)
    {
        //
    }

    public function delete($id){
        $community_service = CommunityService::findOrfail($id);
        $community_service->delete();
        return redirect()->route('community_service.index')->withError('Deleted Successfully');
    }
}
