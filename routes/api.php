<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Device;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('devices', function() {
    return Device::all();
});

Route::get('devices/{id}', function($id) {
    return Device::find($id);
});

Route::post('devices', function(Request $request) {
    return Device::create($request->all);
});

Route::put('devices/{id}', function(Request $request, $id) {
    $device = Device::findOrFail($id);
    $device->update($request->all());

    return $device;
});

Route::delete('devices/{id}', function($id) {
    Device::find($id)->delete();

    return 204;
});