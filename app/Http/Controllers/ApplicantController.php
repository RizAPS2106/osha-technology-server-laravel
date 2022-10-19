<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Helpers\APIFormatter;
use App\Http\Requests\UpdateApplicantRequest as RequestUpdateApplicantRequest;
use App\Http\Requests\ApplyRequest as RequestsApplyRequest;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Applicant::all();

        if ($data) {
            return $data;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsApplyRequest $request)
    {
        $applicant = Applicant::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'position' => $request['position'],
            'birthPlace' => $request['birthPlace'],
            'birthDate' => $request['birthDate'],
            'gender' => $request['gender'],
            'status' => $request['status'],
            'latest_education' => $request['education'],
            'education_period' => $request['edufrom'] . ' - ' . $request['eduto'],
            'latest_work' => $request['workingexp'],
            'work_period' => $request['workfrom'] . ' - ' . $request['workto'],
            'work_position' => $request['workingpos'],
            'work_description' => $request['workingdesc'],
            'it_capabilities' => $request['capabilities'],
        ]);

        $data = Applicant::where('id', '=', $applicant->id)->get();

        if ($data) {
            return APIFormatter::createAPI(200, 'Success', $data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function show(Applicant $applicant, $id)
    {
        $data = Applicant::where('id', '=', $id)->get();

        if ($data) {
            return APIFormatter::createAPI(200, 'Success', $data);
        } else {
            return APIFormatter::createAPI(400, 'Failed');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function edit(Applicant $applicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function update(RequestUpdateApplicantRequest $request, Applicant $applicant, $id)
    {
        $applicant = Applicant::findOrFail($id);

        $applicant->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'position' => $request['position'],
            'birthPlace' => $request['birthPlace'],
            'birthDate' => $request['birthDate'],
            'gender' => $request['gender'],
            'status' => $request['status'],
            'latest_education' => $request['education'],
            'education_period' => $request['edufrom'] . '-' . $request['eduto'],
            'latest_work' => $request['workingexp'],
            'work_period' => $request['workfrom'] . '-' . $request['workto'],
            'work_position' => $request['workingpos'],
            'work_description' => $request['workingdesc'],
            'it_capabilities' => $request['capabilities'],
        ]);

        $data = Applicant::where('id', '=', $applicant->id)->get();

        if ($data) {
            return APIFormatter::createAPI(200, 'Success', $data);
        } else {
            return APIFormatter::createAPI(400, 'Failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Applicant $applicant, $id)
    {
        $applicant = Applicant::findOrFail($id);

        $data = $applicant->delete();

        if ($data) {
            return APIFormatter::createAPI(200, 'Destroy Data Success');
        } else {
            return APIFormatter::createAPI(400, 'Failed');
        }
    }

    // public function view_pdf($id)
    // {
    //     $applicant = Applicant::findOrFail($id);

    //     $pdf = PDF::loadview('applicant_pdf', ['applicant' => $applicant]);
    //     return $pdf->stream('applicant-cv');
    // }

    // public function download_pdf($id)
    // {
    //     $applicant = Applicant::findOrFail($id);

    //     $pdf = PDF::loadview('applicant_pdf', ['applicant' => $applicant]);
    //     return $pdf->download('applicant-cv');
    // }
}
