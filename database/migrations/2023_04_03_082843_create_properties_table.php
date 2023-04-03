<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('property_type_id')->references('id')->on('property_types')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name');
            $table->string('cover_image');
            $table->string('rent_payment_day');
            $table->boolean('is_active')->default(true);
            $table->double('late_payment_charge');
            $table->foreignId('county_id')->nullable()->references('id')->on('counties')->onDelete(null)->cascadeOnUpdate();
            $table->foreignId('subcounty_id')->nullable()->references('id')->on('subcounties')->onDelete(null)->cascadeOnUpdate();
            $table->string('nearest_landmark')->nullable();
            $table->string('street')->nullable();
            $table->date('agreement_start_date');
            $table->date('agreement_end_date');
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
};
