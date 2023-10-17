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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('salary_id');
            $table->integer('amount')->default(0);
            $table->double('advance', 8, 2)->default(0.00);
            $table->double('due', 8, 2)->default(0.00);
            $table->double('net_pay', 8, 2)->default(0.00);
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('type')->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->string('bank_details')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=>Active, 2=>Deactive');
            $table->timestamps();

            // Define foreign key relationship
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            //$table->foreign('bank_id')->references('id')->on('employee_bank_account_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');

    }
};
