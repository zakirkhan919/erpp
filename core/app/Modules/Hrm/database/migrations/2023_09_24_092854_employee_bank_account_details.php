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
        Schema::create('employee_bank_acoount_details', function (Blueprint $table) {
            $table->id();
            $table->string('account_name');
            $table->string('account_no');
            $table->string('bank_name');
            $table->string('ifsc_code');
            $table->string('pan_no');
            $table->string('branch');
            $table->unsignedBigInteger('employee_id');
            $table->timestamps();
            $table->foreign('employee_id')->references('id')->on('employees')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_bank_acoount_details');

    }
};
