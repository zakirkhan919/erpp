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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('roaster_id')->unsigned();
            $table->bigInteger('emp_id')->unsigned();
            $table->string('employee_id', 50)->nullable();
            $table->date('date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->time('late')->nullable();
            $table->integer('hours')->default(8)->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
            $table->foreign('roaster_id')->references('id')->on('roasters')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('emp_id')->references('id')->on('employees')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
};
