<?php

namespace App\Http\Controllers;

use App\Models\Tools;
use App\Models\Experience;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Helpers\APIFormatter;

class ToolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $latest_experience = Experience::latest()->first();;
        $data = Tools::where('experience_id', '=', $latest_experience->id)->get();

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

        $filteredArray = Arr::where($request['workingtoolarray'], function ($value, $key) {
            return $value['value'] != "";
        });

        for ($i = 0; $i < count($filteredArray); $i++) {
            $tools[] = [
                'experience_id' => $latest_experience->id,
                'work_tool' => $filteredArray[$i]['value']
            ];
        }

        Tools::insert($tools);

        $data = Tools::where('experience_id', '=', $latest_experience->id,)->get();

        if ($data) {
            return APIFormatter::createAPI(200, 'Success', $data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tools  $tools
     * @return \Illuminate\Http\Response
     */
    public function show(Tools $tools, $id)
    {
        $data = Tools::where('experience_id', '=', $id)->get();

        if ($data) {
            return $data;
        } else {
            return APIFormatter::createAPI(400, 'Failed');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tools  $tools
     * @return \Illuminate\Http\Response
     */
    public function edit(Tools $tools)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tools  $tools
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tools $tools)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tools  $tools
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tools $tools)
    {
        //
    }
}
