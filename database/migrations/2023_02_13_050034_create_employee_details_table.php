<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_details', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('employeeId');
            $table->longText('address')->nullable();
            $table->string('profilePhoto')->nullable();
            $table->string('covar')->nullable();
            $table->string('username')->nullable();
            $table->string('bio')->nullable();
            $table->string('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('startDate')->nullable();
            $table->string('designation')->nullable();
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
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
        Schema::dropIfExists('employee_details');
    }
}
