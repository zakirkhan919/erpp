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
        Schema::create('leave_applications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->date('from_date');
            $table->date('to_date');
            $table->string('leave_type')->comment('sick, casual, half day, maternity, unpaid, other');
            $table->text('reason')->nullable();
            $table->timestamp('applied_on')->nullable();
            $table->string('status')->nullable()->comment('pending, approve, reject');
            $table->longText('file')->nullable();
            $table->integer('total_day')->nullable();
            $table->softDeletes();
            $table->timestamps();
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
        Schema::dropIfExists('leave_applications');
    }
};
