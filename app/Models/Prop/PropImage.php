<?php

namespace App\Models\Prop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropImage extends Model
{
    use HasFactory;

    protected $table = "prop_image";

    protected $fillable = [
        'prop_id',
        'image',
    ];

    public $timestamps = true;
}
