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
        Schema::create('roaster_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('roaster_id')->unsigned();
            $table->foreign('roaster_id')->references('id')->on('roasters')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('emp_id')->unsigned();
            $table->foreign('emp_id')->references('id')->on('employees')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('roaster_person_id')->unsigned();
            $table->foreign('roaster_person_id')->references('id')->on('employees')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('roaster_histories');
    }
};
