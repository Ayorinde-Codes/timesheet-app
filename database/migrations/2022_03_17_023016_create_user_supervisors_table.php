<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSupervisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_supervisors', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('GenEntityID')->nullable();
            $table->unsignedInteger('primary_supervisor')->nullable();
            $table->unsignedInteger('secondary_supervisor')->nullable();
            $table->timestamp('start_date')->nullable();  
            $table->timestamp('end_date')->nullable();  
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
        Schema::dropIfExists('user_supervisors');
    }
}
