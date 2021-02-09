<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantillas', function (Blueprint $table) {
            $table->id();
            $table->string('item_no', 100);
            $table->foreignId('position_id')->constrained();
            $table->foreignId('department_id')->constrained();
            $table->integer('step');
            $table->string('schedule', 100);
            $table->unsignedBigInteger('incumbent');
            $table->unsignedBigInteger('vacated_by');
            $table->foreign('incumbent')->references('id')->on('employees');
            $table->foreign('vacated_by')->references('id')->on('employees');
            $table->string('abolish', 100)->nullable();
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
        Schema::dropIfExists('plantillas');
    }
}
