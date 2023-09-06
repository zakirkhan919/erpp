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
        Schema::create('salary_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->tinyInteger('type')->default(1)->comment('1=amount, 2=percentage');
            $table->tinyInteger('with_without_basic')->default(1)->comment('1=with, 2=without');
            $table->double('basic', 8, 2)->default(0.00);
            $table->double('medical_allowance', 8, 2)->default(0.00);
            $table->double('provident_found', 8, 2)->default(0.00);
            $table->double('house_rent', 8, 2)->default(0.00);
            $table->double('incentive', 8, 2)->default(0.00);
            $table->timestamps();

            // Define foreign key relationship
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary_settings');
    } 

};
