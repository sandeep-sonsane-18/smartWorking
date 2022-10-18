<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('county',255);
            $table->string('country',255);
            $table->string('town',255);
            $table->string('description',1000);
            $table->string('full_details_url',255);
            $table->string('displayable_name',255);
            $table->string('image_url',255);
            $table->string('thumbnail_url',255);
            $table->string('latitude',255);
            $table->string('longitude',255);
            $table->string('no_of_bedrooms',255);
            $table->string('no_of_bathrooms',255);
            $table->float('price',10,2);
            $table->string('property_type',255);
            $table->enum('for_sale_rent',['','For Sale', 'For Rent']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
