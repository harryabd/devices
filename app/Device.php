<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = ['name', 'address', 'longitude', 'latitude', 'device_type', 'manufacturer', 'model', 'install_date', 'notes', 'eui', 'serial_number', 'upload_id'];

    /**
     * validateDateInput checks that a date time object can be created from the string and returns in mysql format
     *
     * @param string $inputString
     * @return string|false
     */
    public static function validateDateInput($inputString)
    {
        try {
            $dateTime = new \DateTime($inputString);
            return $dateTime->format('Y-m-d H:i:s');
        } catch (\Throwable $e) {
            return false;
        }
    }
}
