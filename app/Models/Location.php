<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_name',
        'location_description',
        'location_category',
        'latitude',
        'longitude'
    ];

    protected $primaryKey = 'id_location';
}
