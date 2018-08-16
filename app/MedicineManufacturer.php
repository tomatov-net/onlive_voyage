<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicineManufacturer extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];
}
