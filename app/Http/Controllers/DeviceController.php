<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;

class DeviceController extends Controller
{
    /**
     * index linked to GET /devices/ endpoint
     *
     * @return void
     */
    public function index()
    {
        return Device::all();
    }

    /**
     * show linked to GET /devices/{id}/ endpoint
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        return Device::find($id);
    }

    /**
     * store linked to POST /devices/ endpoint
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        return Device::create($request->all());
    }

    /**
     * update linked to PUT /devices/{id}/ endpoint
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $device = Device::findOrFail($id);
        $device->update($request->all());

        return $device;
    }

    /**
     * delete linked to DELETE /devices/{id}/ endpoint
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function delete(Request $request, $id)
    {
        $device = Device::findOrFail($id);
        $device->delete();

        return 204;
    }
}
