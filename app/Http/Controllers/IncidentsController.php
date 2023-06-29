<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;

use App\Models\Incident;

use Carbon\Carbon;
class IncidentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $incident = new Incident;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            //
            $input['image'] = $image_name;

            $destination_path = public_path().'/images/incidents_img/';
            // if(!File::exists($destination_path)){
            //     File::makeDirectory($destination_path,0777,true);
            // }

            //Storage::put($destination_path, $image_name);
            $request->file('image')->move($destination_path,  Carbon::now().'-'.$request->drpIncidentType.'-'.$image_name);
            $incident->incident_type_id = $request->drpIncidentType;
            $incident->created_by_users_id = Auth::user()->id;
            $incident->location = $request->txtLocation;
            $incident->lat = $request->txtLatitude;
            $incident->lng = $request->txtLongitude;
            $incident->description = $request->txtDesc;
            $incident->image = $image_name;
            $incident->datetime_incident = $request->txtDateTime;
            $incident->save();

            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}