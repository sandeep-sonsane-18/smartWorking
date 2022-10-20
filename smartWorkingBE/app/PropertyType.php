<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    protected $fillable = [
        "property_id",
        "title",
        "description",
        "created_at",
    ];
}
