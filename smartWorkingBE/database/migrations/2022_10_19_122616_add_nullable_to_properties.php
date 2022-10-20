<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableToProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function($table){

            DB::statement("ALTER TABLE `properties` CHANGE `county` `county` VARCHAR(255) DEFAULT NULL");
            DB::statement("ALTER TABLE `properties` CHANGE `country` `country` VARCHAR(255) DEFAULT NULL");
            DB::statement("ALTER TABLE `properties` CHANGE `town` `town` VARCHAR(255) DEFAULT NULL");
            DB::statement("ALTER TABLE `properties` CHANGE `description` `description` VARCHAR(1000) DEFAULT NULL");
            DB::statement("ALTER TABLE `properties` CHANGE `full_details_url` `full_details_url` VARCHAR(255) DEFAULT NULL");
            DB::statement("ALTER TABLE `properties` CHANGE `displayable_name` `displayable_name` VARCHAR(255) DEFAULT NULL");
            DB::statement("ALTER TABLE `properties` CHANGE `image_url` `image_url` VARCHAR(255) DEFAULT NULL");
            DB::statement("ALTER TABLE `properties` CHANGE `thumbnail_url` `thumbnail_url` VARCHAR(255) DEFAULT NULL");
            DB::statement("ALTER TABLE `properties` CHANGE `latitude` `latitude` VARCHAR(255) DEFAULT NULL");
            DB::statement("ALTER TABLE `properties` CHANGE `longitude` `longitude` VARCHAR(255) DEFAULT NULL");
            DB::statement("ALTER TABLE `properties` CHANGE `no_of_bedrooms` `no_of_bedrooms` VARCHAR(255) DEFAULT NULL");
            DB::statement("ALTER TABLE `properties` CHANGE `no_of_bathrooms` `no_of_bathrooms` VARCHAR(255) DEFAULT NULL");
            DB::statement("ALTER TABLE `properties` CHANGE `price` `price` DOUBLE(10,2) DEFAULT NULL");
            DB::statement("ALTER TABLE `properties` CHANGE `property_type` `property_type` VARCHAR(255) DEFAULT NULL");

            // $table->string('county')->nullable()->change();
            // $table->string('country')->nullable()->change();
            // $table->string('town')->nullable()->change();
            // $table->string('description')->nullable()->change();
            // $table->string('full_details_url')->nullable()->change();
            // $table->string('displayable_name')->nullable()->change();
            // $table->string('image_url')->nullable()->change();
            // $table->string('thumbnail_url')->nullable()->change();
            // $table->string('latitude')->nullable()->change();
            // $table->string('longitude')->nullable()->change();
            // $table->string('no_of_bedrooms')->nullable()->change();
            // $table->string('no_of_bathrooms')->nullable()->change();
            // $table->string('price')->nullable()->change();
            // $table->string('property_type')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
