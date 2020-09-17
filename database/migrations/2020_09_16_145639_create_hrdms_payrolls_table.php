<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrdmsPayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrdms_payrolls', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_received');
            $table->date('date1')->nullable();
            $table->date('date2')->nullable();
            $table->string('description', 100);
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
        Schema::dropIfExists('hrdms_payrolls');
    }
}
