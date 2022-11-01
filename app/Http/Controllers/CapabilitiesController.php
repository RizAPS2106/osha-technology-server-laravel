<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Capabilities;
use Illuminate\Http\Request;
use App\Helpers\APIFormatter;

class CapabilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $latest_applicant = Applicant::latest()->first();
        $data = Capabilities::where('applicant_id', '=', $latest_applicant->id);

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

        for ($i = 0; $i < count($request['capabilities']); $i++) {
            $capabilities[] = [
                'applicant_id' => $latest_applicant->id,
                'capability' => $request['capabilities'][$i]['value']
            ];
        }

        Capabilities::insert($capabilities);

        $data = Capabilities::where('applicant_id', '=', $latest_applicant->id,)->get();

        if ($data) {
            return APIFormatter::createAPI(200, 'Success', $data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Capabilities  $capabilities
     * @return \Illuminate\Http\Response
     */
    public function show(Capabilities $capabilities, $id)
    {
        $data = Capabilities::where('applicant_id', '=', $id)->get();

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
     * @param  \App\Models\Capabilities  $capabilities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Capabilities $capabilities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Capabilities  $capabilities
     * @return \Illuminate\Http\Response
     */
    public function destroy(Capabilities $capabilities)
    {
        //
    }
}
