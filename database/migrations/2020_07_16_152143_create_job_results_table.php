<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_results', function (Blueprint $table) {
            $table->id('job_result_id');
            $table->string('job');
            $table->integer('status');
            $table->json('result');
            $table->timestamps();

            $table->index(['job']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_results');
    }
}
