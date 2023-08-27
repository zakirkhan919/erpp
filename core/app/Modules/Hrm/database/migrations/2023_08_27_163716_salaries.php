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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->double('regular_salary', 8, 2)->default(0.00);
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('salary_given_date')->nullable();
            $table->double('medical_allowance', 8, 2)->default(0.00);
            $table->double('provident_found', 8, 2)->default(0.00);
            $table->double('house_rent', 8, 2)->default(0.00);
            $table->double('incentive', 8, 2)->default(0.00);
            $table->float('insurance')->default(0);
            $table->float('tat')->default(0);
            $table->double('tax', 8, 2)->default(0.00);
            $table->double('total', 8, 2)->default(0.00);
            $table->float('roaster_hours')->nullable();
            $table->float('working_hours')->nullable();
            $table->double('advance', 8, 2)->default(0.00);
            $table->double('fine', 8, 2)->default(0.00);
            $table->integer('present')->default(0);
            $table->integer('absent')->default(0);
            $table->integer('late_day')->default(0);
            $table->double('net_pay', 8, 2)->default(0.00);
            $table->double('miscellaneous_addition', 8, 2)->default(0.00);
            $table->double('miscellaneous_deduction', 8, 2)->default(0.00);
            $table->string('payment_status')->default('unpaid');
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
        Schema::dropIfExists('salaries');
    }
};
