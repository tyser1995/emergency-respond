<?php

namespace App\Http\Controllers;

use App\Models\MedicalAssistanceBloodDonation;
use Illuminate\Http\Request;

class MedicalAssistanceBloodDonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $blood_donation = MedicalAssistanceBloodDonation::get();
        return view('medical_assistance.blood_donation.index',[
            'blood_donation' => $blood_donation
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
        return view('medical_assistance.blood_donation.create');
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

        $blood_donation = new MedicalAssistanceBloodDonation;
        $blood_donation->fullname = $request->fullname;
        $blood_donation->contact = $request->contact;
        $blood_donation->email = $request->email;
        $blood_donation->organization = $request->organization;
        $blood_donation->message = $request->message;
        $blood_donation->blood_type = $request->blood_type;
        $blood_donation->save();

        return redirect()->back()->withStatus("Successfully added");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicalAssistanceBloodDonation  $medicalAssistanceBloodDonation
     * @return \Illuminate\Http\Response
     */
    public function show(MedicalAssistanceBloodDonation $medicalAssistanceBloodDonation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicalAssistanceBloodDonation  $medicalAssistanceBloodDonation
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicalAssistanceBloodDonation $medicalAssistanceBloodDonation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedicalAssistanceBloodDonation  $medicalAssistanceBloodDonation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicalAssistanceBloodDonation $medicalAssistanceBloodDonation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicalAssistanceBloodDonation  $medicalAssistanceBloodDonation
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicalAssistanceBloodDonation $medicalAssistanceBloodDonation)
    {
        //
    }

    public function delete($id){
        $blood_donation = MedicalAssistanceBloodDonation::findOrfail($id);
        $blood_donation->delete();
        return redirect()->route('blood_donation.index')->withError('Deleted Successfully');
    }


}
