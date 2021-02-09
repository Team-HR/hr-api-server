<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('gender', 100)->nullable()->default(NULL)->after('ext_name');
            $table->string('status', 100)->nullable()->default(NULL)->after('gender');
            $table->string('employment_status', 100)->nullable()->default(NULL)->after('status');
            $table->string('nature_of_assignment', 100)->nullable()->default(NULL)->after('employment_status');
            $table->date('date_activated')->nullable()->default(NULL)->after('nature_of_assignment');
            $table->date('date_inactivated')->nullable()->default(NULL)->after('date_activated');
            $table->date('date_ipcr')->nullable()->default(NULL)->after('date_inactivated');
            $table->foreignId('position_id')->after('employment_status')->nullable()->default(NULL)->constrained();
            $table->foreignId('department_id')->after('position_id')->nullable()->default(NULL)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropForeign(['position_id']);
            $table->dropColumn([
                'gender',
                'status',
                'employment_status',
                'department_id',
                'position_id',
                'nature_of_assignment',
                'date_activated',
                'date_inactivated',
                'date_ipcr'
            ]);
        });
    }
}
