<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'category_id',
        'manufacturer_id',
    ];

    public function category()
    {
        return $this->belongsTo('App\MedicineCategory', 'category_id');
    }

    public function manufacturer()
    {
        return $this->belongsTo('App\MedicineManufacturer', 'manufacturer_id');
    }
}
