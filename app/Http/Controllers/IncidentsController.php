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
use Illuminate\Support\Facades\DB;

use App\Models\Incident;
use App\Models\IncidentType;

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
        $archived_incident = Incident::get();
        foreach($archived_incident as $value){
            if($value->created_at->diffInDays(Carbon::now()) > 7){
                $archive = Incident::findOrFail($value->id);
                $archive->deleted_flag = 1;
                $archive->update();
            }

        }


        $incident = Incident::join('incident_types','incident_types.id','=','incidents.incident_type_id')
        ->where('incidents.deleted_flag',0)
        ->orderBy('incidents.created_at','DESC')
        ->select('incidents.*','incident_types.incident_name')
        ->get();

        return view('incidents.index',[
            'incident' => $incident
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
        $incident_type = IncidentType::findOrFail($request->drpIncidentType);
        $incident = new Incident;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            //
            $input['image'] = $image_name;

            $destination_path = "";
            if(env('APP_ENV') == "local")
                $destination_path = public_path().'/images/incidents_img/'.$incident_type->incident_name;
            else{
                $destination_path = base_path().'/public/images/incidents_img/'.$incident_type->incident_name;
            }


            //$destination_path = base_path().'/blogf/storage/app/public/images/';
            //

             if(!File::exists($destination_path)){
                 File::makeDirectory($destination_path,0777,true);
             }

             if(!file_exists($destination_path)){
                File::makeDirectory($destination_path,0755,true);
            }

            //Storage::put($destination_path, $image_name);
            if(isset($image)){
                $imgFileOrig = Image::make($image)->save($destination_path.'/'.$image_name);
                // $imgFileOrig = Image::make($image)->save($destination_path.'/'.str_replace(":","-",Carbon::now()).'-'.$request->drpIncidentType.'-'.$image_name);
                // $imgFile = Image::make($image)->resize(450, null, function($constraint){
                //     $constraint->aspectRatio();
                // })->save($destination_path.'/'.str_replace(":","-",Carbon::now()).'-'.$request->drpIncidentType.'-'.$image_name);
            }

            // $request->file('image')->move($destination_path,  str_replace(":","-",Carbon::now()).'-'.$request->drpIncidentType.'-'.$image_name);
            $incident->incident_type_id = $request->drpIncidentType;
            $incident->created_by_users_id = Auth::user()->id;
            $incident->location = $request->txtLocation;
            $incident->lat = $request->txtLatitude;
            $incident->lng = $request->txtLongitude;
            $incident->description = $request->txtDesc;
            $incident->image = $image_name;
            $incident->datetime_incident = $request->txtDateTime;
            $incident->save();

            return redirect()->route('dashboard');
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

    public function delete($id){
        $incident_types = Incident::findOrfail($id);
        $incident_types->deleted_flag = 1;
        $incident_types->update();
        return redirect()->route('incident.index')->withError('Deleted Successfully');
    }
}
