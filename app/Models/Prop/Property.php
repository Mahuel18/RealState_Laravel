<?php

namespace App\Models\Prop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = "props";

    protected $fillable = [
        'title',
        'price',
        'image',
        'beds',
        'baths',
        'sq_ft',
        'home_type',
        'year_built',
        'price/sqft',
        'more_info',
        'location',
        'agent_name',
    ];

    public $timestamps = true;
}
