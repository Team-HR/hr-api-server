<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->string('type', 100)->nullable();
            $table->string('designation', 100)->nullable();
            $table->float('salary_rate')->nullable();
            $table->boolean('is_per_session')->nullable();
            $table->float('rate_on_schedule')->nullable();
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->string('place_of_assignment', 100)->nullable();
            $table->string('branch', 100)->nullable();
            $table->string('memo', 100)->nullable();
            $table->string('status', 100)->nullable();
            $table->string('remarks', 100)->nullable();
            $table->string('session', 100)->nullable();
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
        Schema::dropIfExists('service_records');
    }
}
