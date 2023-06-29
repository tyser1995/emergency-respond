<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;

use App\Models\IncidentType;

class IncidentTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $incident_type = IncidentType::where('deleted_flag',0)
        ->orderBy('incident_name','asc')
        ->get();
        return view('incident_types.index',[
            'incident_type' => $incident_type
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
        return view('incident_types.create');
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
        $incident_type = new IncidentType;
        $count = $incident_type::where('incident_name','=',$request->incident_name)
        ->where('deleted_flag',0);
        if($count->count() == 0)
        {
            $incident_type->incident_name = $request->incident_name;
            $incident_type->save();
            return redirect()->route('incident_type.index')->withStatus('Created Successfully');
        }
        return redirect()->back()->withError('Data already exists ' .$request->incident_name);
            
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
    public function edit(IncidentType $incident_type)
    {
        //
        return view('incident_types.edit',[
            'incident_type' => $incident_type
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IncidentType $incident_type)
    {
        //

        $incident_types = IncidentType::findOrfail($incident_type->id);
        $incident_types->incident_name = $request->incident_name;
        $incident_types->update();
        return redirect()->route('incident_type.index')->withStatus('Successfully Updated.');
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
        $incident_types = IncidentType::findOrfail($id);
        $incident_types->deleted_flag = 1;
        $incident_types->update();
        return redirect()->route('incident_type.index')->withError('Deleted Successfully ' .$incident_types->incident_name);
    }
}
