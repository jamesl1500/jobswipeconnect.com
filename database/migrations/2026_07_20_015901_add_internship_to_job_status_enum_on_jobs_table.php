<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddInternshipToJobStatusEnumOnJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE jobs MODIFY COLUMN job_status ENUM('full-time','part-time','contract','temporary','internship','other') NOT NULL DEFAULT 'full-time'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("UPDATE jobs SET job_status = 'other' WHERE job_status = 'internship'");
        DB::statement("ALTER TABLE jobs MODIFY COLUMN job_status ENUM('full-time','part-time','contract','temporary','other') NOT NULL DEFAULT 'full-time'");
    }
}
