<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained();
            $table->string("title");
            $table->string("company");
            $table->date("start_date");
            $table->string('location');
            $table->string('salary');
            $table->string('description');
            $table->string('skills');
            $table->string('requirements');
            $table->string('responsibilities');
            $table->string('benefits');
            $table->enum("employment_location_type",["remote","hybrid", "On Site"])->default("remote");
            $table->enum("status",["active","inactive"])->default("active");
            $table->enum("experience_level",["internship","entry-level","associate","mid-senior-level","director","executive"])->default("entry-level");
            $table->enum("education_level",["high-school","diploma","certificate","associate","bachelor","master","doctorate","other"])->default("bachelor");
            $table->enum("job_category",["accounting","administrative","advertising","banking","business","community","construction","customer-service","design","education","engineering","finance","healthcare","hospitality","human-resources","information-technology","legal","management","manufacturing","marketing","media","non-profit","real-estate","retail","sales","science","security","skilled-labor","transportation","other"])->default("other");
            $table->enum("job_level",["entry-level","associate","mid-senior-level","director","executive"])->default("entry-level");
            $table->enum("job_shift",["morning","afternoon","evening","night","flexible","rotating","other"])->default("morning");
            $table->enum("job_status",["full-time","part-time","contract","temporary","other"])->default("full-time");
            $table->enum("job_salary_type",["hourly","salaried","commission","bonus","other"])->default("salaried");
            $table->enum("job_salary_currency",["usd","cad","eur","gbp","aud","other"])->default("usd");
            $table->enum("job_salary_period",["hour","day","week","month","year","other"])->default("year");
            $table->enum("job_salary_pay",["hourly","daily","weekly","bi-weekly","monthly","yearly","other"])->default("yearly");
            $table->string('job_salary_from');
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
        Schema::dropIfExists('jobs');
    }
}
