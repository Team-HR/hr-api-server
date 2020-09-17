<?php

use Brick\Math\BigInteger;
use Hamcrest\Type\IsBoolean;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrdmsAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrdms_appointments', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_received');
            $table->string('name', 100);
            $table->string('position', 100);
            $table->date('date_of_effectivity');
            $table->boolean('needs_revision');
            $table->string('remarks', 100)->nullable();
            $table->boolean('is_complete');
            $table->dateTime('date_completed')->nullable();
            $table->bigInteger('turn_around_time')->nullable();
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
        Schema::dropIfExists('hrdms_appointments');
    }
}
