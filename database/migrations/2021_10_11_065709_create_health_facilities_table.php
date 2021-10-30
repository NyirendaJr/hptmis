<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_facilities', function (Blueprint $table) {
            $table->id();
            $table->string('facility_number')->nullable();
            $table->string('facility_name');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('common_name')->nullable();
            $table->string('region')->nullable();
            $table->string('district')->nullable();
            $table->string('council')->nullable();
            $table->string('ward')->nullable();
            $table->string('street')->nullable();
            $table->string('facility_type')->nullable();
            $table->string('operating_status')->nullable();
            $table->string('ownership')->nullable();
            $table->string('date_opened')->nullable();
            $table->string('official_phone_number')->nullable();
            $table->string('mtuha')->nullable();
            $table->string('ctc_id')->nullable();
            $table->string('msd_id')->nullable();
            $table->string('postal_address')->nullable();
            $table->string('official_email')->nullable();
            $table->string('website')->nullable();
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
        Schema::dropIfExists('health_facilities');
    }
}
