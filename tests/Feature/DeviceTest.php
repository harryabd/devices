<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Device;

class DeviceTest extends TestCase
{
    public function testGetDevices()
    {
        $response = $this->json('GET', '/api/devices/');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'name', 'address', 'longitude', 'latitude', 'device_type', 'manufacturer', 'model', 'install_date', 'notes', 'eui', 'serial_number', 'created_at', 'updated_at']
        ]);
    }

    public function testGetDevice()
    {
        $response = $this->json('GET', '/api/devices/1/');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id', 'name', 'address', 'longitude', 'latitude', 'device_type', 'manufacturer', 'model', 'install_date', 'notes', 'eui', 'serial_number', 'created_at', 'updated_at'
        ]);
    }

    public function testCreateDevice()
    {
        $payload = [
            'name' => 'TestUser',
            'address' => '1 The Road\nThe Town\nTheCounty\nTest123',
            'latitude' => 123.123,
            'longitude' => 321.321321,
            'device_type' => 'Test',
            'manufacturer' => 'TestManufacturer',
            'model' => 'TestModel',
            'install_date' => '1999-05-15 03:21:32',
            'notes' => 'This is a test device',
            'eui' => 'asdjkfhaljgh-2394568',
            'serial_number' => 41534,
            'upload_id' => 12
        ];
        $response = $this->json('POST', '/api/devices/', $payload);
        $response->assertStatus(201);
    }

    public function testUpdateDevice()
    {
        $name = 'OverwritternName';
        $payload = [
            'name' =>  $name
        ];
        $response = $this->json('PUT', '/api/devices/1/', $payload);
        $response->assertStatus(200);
        $response->assertJson(['name' => $name]);
    }

    public function testDeleteDevice()
    {
        $device = factory(Device::class)->create();
        $response = $this->json('DELETE', '/api/devices/' . $device->id . '/');
        $response->assertStatus(200);
    }
}
