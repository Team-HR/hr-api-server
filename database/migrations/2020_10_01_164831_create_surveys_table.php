<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable()->default('text');
            $table->boolean('is_published')->nullable()->default(false);
            $table->boolean('is_accepting')->nullable()->default(false);
            $table->string('roles', 255)->nullable()->default('text');
            $table->string('departments', 255)->nullable()->default('text');
            $table->boolean('allow_self')->nullable()->default(false);
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
        Schema::dropIfExists('surveys');
    }
}
