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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->foreignId('organization_id')->constrained();
            $table->foreignId('position_id')->constrained();
            $table->foreignId('service_id')->constrained();
            $table->foreignId('location_id')->constrained();

            $table->string('phone')->unique();
            $table->string('short_phone')->unique();
            $table->string('phone_code');
            $table->string('email')->unique();
            $table->text('description');

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
        Schema::dropIfExists('contacts');
    }
};
