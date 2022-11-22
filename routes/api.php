<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\JobDescController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\AdminAccessController;
use App\Http\Controllers\CapabilitiesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('admin_access/register', [AuthController::class, 'register']);
Route::post('admin_access/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('admin_access', [AdminAccessController::class, 'index']);
    Route::post('admin_access/store', [AdminAccessController::class, 'store']);
    Route::get('admin_access/show/{id}', [AdminAccessController::class, 'show']);
    Route::put('admin_access/update/{id}', [AdminAccessController::class, 'update']);
    Route::delete('admin_access/destroy/{id}', [AdminAccessController::class, 'destroy']);
    Route::post('admin_access/logout', [AuthController::class, 'logout']);

    Route::get('applicant', [ApplicantController::class, 'index']);
    Route::get('applicant/show/{id}', [ApplicantController::class, 'show']);
    Route::put('applicant/update/{id}', [ApplicantController::class, 'update']);
    Route::delete('applicant/destroy/{id}', [ApplicantController::class, 'destroy']);

    Route::put('experience/update/{id}', [ExperienceController::class, 'update']);
    Route::delete('experience/destroy/{id}', [ExperienceController::class, 'destroy']);

    Route::put('jobdesc/update/{id}', [JobDescController::class, 'update']);
    Route::delete('jobdesc/destroy/{id}', [JobDescController::class, 'destroy']);

    Route::put('projects/update/{id}', [ProjectsController::class, 'update']);
    Route::delete('projects/destroy/{id}', [ProjectsController::class, 'destroy']);

    Route::put('tools/update/{id}', [ToolsController::class, 'update']);
    Route::delete('tools/destroy/{id}', [ToolsController::class, 'destroy']);

    Route::put('capabilities/update/{id}', [CapabilitiesController::class, 'update']);
    Route::delete('capabilities/destroy/{id}', [CapabilitiesController::class, 'destroy']);
});

Route::post('applicant/store', [ApplicantController::class, 'store']);

Route::get('experience', [ExperienceController::class, 'index']);
Route::post('experience/store', [ExperienceController::class, 'store']);
Route::get('experience/show/{id}', [ExperienceController::class, 'show']);

Route::get('jobdesc', [JobDescController::class, 'index']);
Route::post('jobdesc/store', [JobDescController::class, 'store']);
Route::get('jobdesc/show/{id}', [JobDescController::class, 'show']);

Route::get('projects', [ProjectsController::class, 'index']);
Route::post('projects/store', [ProjectsController::class, 'store']);
Route::get('projects/show/{id}', [ProjectsController::class, 'show']);

Route::get('tools', [ToolsController::class, 'index']);
Route::post('tools/store', [ToolsController::class, 'store']);
Route::get('tools/show/{id}', [ToolsController::class, 'show']);

Route::get('capabilities', [CapabilitiesController::class, 'index']);
Route::post('capabilities/store', [CapabilitiesController::class, 'store']);
Route::get('capabilities/show/{id}', [CapabilitiesController::class, 'show']);
