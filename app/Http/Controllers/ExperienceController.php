<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Experience;
use Illuminate\Http\Request;
use App\Helpers\APIFormatter;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $latest_applicant = Applicant::latest()->first();
        $latest_applicant_id = $latest_applicant->id;
        $data = Experience::where('applicant_id', '=', $latest_applicant_id)->get();

        if ($data) {
            return $data;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $latest_applicant = Applicant::latest()->first();

        $experience = Experience::create([
            'applicant_id' => $latest_applicant->id,
            'work_place' => $request['workingexp'],
            'work_period' => $request['workfrom'] . '-' . $request['workto'],
            'work_position' => $request['workingpos'],
        ]);

        $data = Experience::where('id', '=', $experience->id)->get();

        if ($data) {
            return APIFormatter::createAPI(200, 'Success', $data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Experience  $experienceController
     
     * @return \Illuminate\Http\Response
     */
    public function show(Experience $experience, $id)
    {
        $data = Experience::where('applicant_id', '=', $id)->get();

        if ($data) {
            return $data;
        } else {
            return APIFormatter::createAPI(400, 'Failed');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Experience $experience)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function destroy(Experience $experience)
    {
        //
    }
}
