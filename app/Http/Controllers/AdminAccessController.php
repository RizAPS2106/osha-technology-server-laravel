<?php

namespace App\Http\Controllers;

use App\Helpers\APIFormatter;
use App\Models\AdminAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AdminAccess::all();

        if ($data) {
            return APIFormatter::createAPI(200, 'Success', $data);
        } else {
            return APIFormatter::createAPI(400, 'Failed');
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
        $input = $request->validate([
            'username' => 'required|unique:admin_access,username',
            'password' => 'required|confirmed',
        ]);

        $admin_access = AdminAccess::create([
            'username' => $input['username'],
            'password' => Hash::make($input['password']),
        ]);


        $data = AdminAccess::where('id', '=', $admin_access->id)->get();

        if ($data) {
            return APIFormatter::createAPI(200, 'Success', $data);
        } else {
            return APIFormatter::createAPI(400, 'Failed');
        }
    }   

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminAccess  $adminAccess
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = AdminAccess::where('id', '=', $id)->get();

        if ($data) {
            return APIFormatter::createAPI(200, 'Success', $data);
        } else {
            return APIFormatter::createAPI(400, 'Failed');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminAccess  $adminAccess
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminAccess $adminAccess)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminAccess  $adminAccess
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminAccess $adminAccess, $id)
    {
        $input = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin_access = AdminAccess::findOrFail($id);

        $admin_access->update([
            'username' => $input['username'],
            'password' => $input['password'],
        ]);

        $data = AdminAccess::where('id', '=', $admin_access->id)->get();

        if ($data) {
            return APIFormatter::createAPI(200, 'Success', $data);
        } else {
            return APIFormatter::createAPI(400, 'Failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminAccess  $adminAccess
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminAccess $adminAccess, $id)
    {
        $admin_access = AdminAccess::findOrFail($id);

        $data = $admin_access->delete();

        if ($data) {
            return APIFormatter::createAPI(200, 'Destroy Data Success');
        } else {
            return APIFormatter::createAPI(400, 'Failed');
        }
    }
}
