<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use Illuminate\Support\Facades\DB;

class IncidentArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $incident = Incident::join('incident_types','incident_types.id','=','incidents.incident_type_id')
        ->where('incidents.deleted_flag',1)
        ->orderBy('incidents.created_at','DESC')
        ->select('incidents.*','incident_types.incident_name')
        ->get();

        $incident_archived = Incident::join('incident_types','incident_types.id','=','incidents.incident_type_id')
        ->where('incidents.deleted_flag',1)
        ->orderBy('incident_types.incident_name')
        ->select('incident_types.incident_name',DB::raw('count(incidents.id) as count'))
        ->groupBy('incident_types.incident_name')
        ->get();

        return view('incidents_archived.index',[
            'incident' => $incident,
            'incident_archived' => $incident_archived
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
