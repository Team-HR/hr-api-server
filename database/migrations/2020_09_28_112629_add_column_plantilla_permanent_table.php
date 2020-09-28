<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPlantillaPermanentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plantilla_permanent', function (Blueprint $table) {
            $table->string('abolish_reason', 255)->after('abolish')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plantilla_permanent', function (Blueprint $table) {
            $table->dropColumn('abolish_reason');
        });
    }
}
