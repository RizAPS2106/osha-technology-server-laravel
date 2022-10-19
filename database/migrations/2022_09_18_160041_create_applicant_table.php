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
        Schema::create('applicant', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('position');
            $table->string('birthPlace');
            $table->string('birthDate');
            $table->string('gender');
            $table->string('status');
            $table->string('latest_education');
            $table->string('education_period');
            $table->string('latest_work');
            $table->string('work_period');
            $table->string('work_position');
            $table->text('work_description');
            $table->text('it_capabilities');
            $table->softDeletes();
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
        Schema::dropIfExists('applicant');
    }
};
