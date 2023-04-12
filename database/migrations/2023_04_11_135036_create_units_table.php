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
      Schema::create('units', function (Blueprint $table) {
          $table->id();
          $table->foreignId('property_id')->references('id')->on('properties')->onDelete('cascade')->cascadeOnUpdate();
          $table->foreignId('unit_type_id')->nullable()->references('id')->on('unit_types')->onDelete(null)->cascadeOnUpdate();
          $table->foreignId('billing_frequency_id')->references('id')->on('billing_frequencies')->onDelete('cascade')->cascadeOnUpdate();
          $table->string('unit_number');
          $table->string('floor_number');
          $table->bigInteger('rent');
          $table->bigInteger('deposit');
          $table->string('cover_image')->nullable();
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
      Schema::dropIfExists('units');
  }
};
