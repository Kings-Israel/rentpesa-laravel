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
        Schema::create('user_units', function (Blueprint $table) {
            $table->id();
            $table->unique(['user_id', 'unit_id']);
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->cascadeOnUpdate();
            $table->foreignId('unit_id')->references('id')->on('units')->onDelete('cascade')->cascadeOnUpdate();
            $table->date('lease_start_date')->nullable()->default(now());
            $table->date('lease_end_date')->nullable()->default(now()->addYear());
            $table->boolean('is_active')->default(true);
            $table->longText('remarks')->nullable();
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
        Schema::dropIfExists('user_units');
    }
};
