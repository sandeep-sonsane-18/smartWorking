<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'properties';

    protected $fillable = [
        "property_type_id",
        "county",
        "country",
        "town",
        "description",
        "full_details_url",
        "displayable_name",
        "image_url",
        "thumbnail_url",
        "latitude",
        "longitude",
        "no_of_bedrooms",
        "no_of_bathrooms",
        "price",
        "property_type",
        "for_sale_rent",
        "created_at",
        "postcode",
    ];

    // public function propertyType()
    // {
    //     return $this->hasOne('App\PropertyType', 'property_id');
    // }
}
