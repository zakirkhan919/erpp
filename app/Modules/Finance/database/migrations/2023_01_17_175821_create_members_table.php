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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->integer('district_id')->nullable();
            $table->integer('thana_id')->nullable();
            $table->integer('union_id')->nullable();
            $table->string('name')->nullable();
            $table->string('ref')->nullable();
            $table->string('village')->nullable();
            $table->string('postOffice')->nullable();
            $table->string('ímage')->nullable();
            $table->text('status')->nullable();
            $table->timestamps();

            // $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            // $table->foreign('thana_id')->references('id')->on('upazilas')->onDelete('cascade');
            // $table->foreign('union_id')->references('id')->on('unions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
};