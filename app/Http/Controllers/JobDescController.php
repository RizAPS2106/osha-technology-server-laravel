<?php

namespace App\Http\Controllers;

use App\Models\JobDesc;
use App\Models\Experience;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Helpers\APIFormatter;

class JobDescController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $latest_experience = Experience::latest()->first();;
        $data = JobDesc::where('experience_id', '=', $latest_experience->id)->get();

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
        $latest_experience = Experience::latest()->first();

        $filteredArray = Arr::where($request['workingdescarray'], function ($value, $key) {
            return $value['value'] != "";
        });

        for ($i = 0; $i < count($filteredArray); $i++) {
            $jobdescs[] = [
                'experience_id' => $latest_experience->id,
                'work_description' => $filteredArray[$i]['value']
            ];
        }

        $jobdesc = JobDesc::insert($jobdescs);

        $data = JobDesc::where('experience_id', '=', $latest_experience->id,)->get();

        if ($data) {
            return APIFormatter::createAPI(200, 'Success', $data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobDesc  $jobDesc
     * @return \Illuminate\Http\Response
     */
    public function show(JobDesc $jobDesc, $id)
    {
        $data = JobDesc::where('experience_id', '=', $id)->get();

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
     * @param  \App\Models\JobDesc  $jobDesc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobDesc $jobDesc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobDesc  $jobDesc
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobDesc $jobDesc)
    {
        //
    }
}
