<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = ['name', 'address', 'longitude', 'latitude', 'device_type', 'manufacturer', 'model', 'install_date', 'notes', 'eui', 'serial_number', 'upload_id'];
}
