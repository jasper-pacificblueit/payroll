<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDateTimeRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('date_time_records', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();

            $table->date('date')->nullable();
            $table->time('in_am')->nullable();
            $table->time('out_am')->nullable();
            $table->time('in_pm')->nullable();
            $table->time('out_pm')->nullable();
            $table->integer('comp_id')->nullable();
            $table->float('total_hours')->nullable();
            
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('date_time_records');
    }
}
