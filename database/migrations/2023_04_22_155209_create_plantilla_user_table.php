<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantillaUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantilla_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('plantilla_id');
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('plantilla_id')->references('id')->on('plantillas');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('plantilla_id')->references('id')->on('plantillas')->onDelete('cascade');
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
        Schema::dropIfExists('plantilla_user');
    }
};
