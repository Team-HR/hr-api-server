<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->foreignId('plantilla_permanent_id')->constrained('plantilla_permanent');
            $table->string('reason_of_vacancy', 255)->nullable();
            $table->string('office_assignment', 100)->nullable();
            $table->string('probationary_period', 100)->nullable();
            $table->string('status_of_appointment', 100)->nullable();
            $table->date('date_of_appointment')->nullable();
            $table->date('date_of_assumption')->nullable();
            $table->date('nature_of_appointment')->nullable();
            $table->string('appointing_authority', 100)->nullable();
            $table->date('date_of_signing')->nullable();
            $table->string('csc_authorized_official', 100)->nullable();
            $table->string('csc_mc_no', 100)->nullable();
            $table->date('assesment_date_from')->nullable();
            $table->date('assesment_date_to')->nullable();
            $table->date('deliberation_date_from')->nullable();
            $table->date('deliberation_date_to')->nullable();
            $table->date('date_signed_by_csc')->nullable();
            $table->foreignId('committee_chair')->constrained('employees');
            $table->foreignId('hrmo_id')->constrained('employees');
            $table->string('cert_fund_available', 100)->nullable();
            $table->string('published_at', 100)->nullable();
            $table->string('posted_in', 100)->nullable();
            $table->date('posted_date')->nullable();
            $table->date('csc_release_date')->nullable();
            $table->string('gov_id_type', 100)->nullable();
            $table->string('gov_id_no', 100)->nullable();
            $table->date('gov_id_issued_date')->nullable();
            $table->date('sworn_date')->nullable();
            $table->date('cert_issued_date')->nullable();
            $table->date('last_day_of_service')->nullable();
            $table->string('supervisor', 100)->nullable();
            $table->date('casual_promotion')->nullable();
            $table->foreignId('predecessor')->constrained('employees');
            $table->date('date_of_last_promotion')->nullable();
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
        Schema::dropIfExists('appointments');
    }
}
