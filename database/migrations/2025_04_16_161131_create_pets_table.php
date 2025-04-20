<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('species');
            $table->string('breed');
            $table->string('age');
            $table->text('image');
            $table->unsignedBigInteger('person_id');
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
