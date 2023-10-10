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
        Schema::create('provident_funds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->double('previous_provident_fund', 8, 2)->default(0.00);
            $table->integer('previous_month')->default(0);
            $table->double('provident_fund', 8, 2)->default(0.00);
            $table->text('remarks')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=>Active, 2=>Deactive');
            $table->timestamps();

            // Define foreign key relationship
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provident_funds');

    }
};
