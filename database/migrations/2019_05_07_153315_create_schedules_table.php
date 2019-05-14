<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('department_id')->unsigned();
            $table->string('type')->nullable(); 
            $table->time('in_am')->nullable();
            $table->time('out_am')->nullable();
            $table->time('in_pm')->nullable();
            $table->time('out_pm')->nullable();
            $table->time('overtime_out')->nullable();
            $table->enum("state", [0, 1, 2, 3]);

            $table->foreign("department_id")->references("id")->on("departments")->onDelete("cascade");
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
        Schema::dropIfExists('schedules');
    }
}
