<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timesheets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('GenEntityID');
            $table->enum('level', [1, 2, 3]);
            $table->enum('status', ['processing', 'successful']);
            $table->integer('time_worked')->nullable();
            $table->integer('standard_time')->nullable();
            $table->integer('over_time')->nullable();
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
        Schema::dropIfExists('timesheets');
    }
}
