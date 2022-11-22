<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\Experience;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Helpers\APIFormatter;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $latest_experience = Experience::latest()->first();;
        $data = Projects::where('experience_id', '=', $latest_experience->id)->get();

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
        $latest_experience = Experience::latest()->first();

        $filteredArray = Arr::where($request['workingprojectarray'], function ($value, $key) {
            return $value['value'] != "";
        });

        $projects = [];
        foreach ($filteredArray as $filledData) {
            $projects[] = [
                'experience_id' => $latest_experience->id,
                'work_project' => $filledData['value']
            ];
        }

        Projects::insert($projects);

        $data = Projects::where('experience_id', '=', $latest_experience->id,)->get();

        if ($data) {
            return APIFormatter::createAPI(200, 'Success', $data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function show(Projects $projects, $id)
    {
        $data = Projects::where('experience_id', '=', $id)->get();

        if ($data) {
            return $data;
        } else {
            return APIFormatter::createAPI(400, 'Failed');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function edit(Projects $projects)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Projects $projects)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projects $projects)
    {
        //
    }
}
