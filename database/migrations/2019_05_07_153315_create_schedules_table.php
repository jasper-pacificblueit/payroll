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
            $table->integer('department_id')->unsigned()->nullable();
            $table->integer('employee_id')->unsigned()->nullable();
            $table->string('type')->nullable(); 
            $table->time('in_am')->nullable();
            $table->time('out_am')->nullable();
            $table->time('in_pm')->nullable();
            $table->time('out_pm')->nullable();
            $table->enum("state", [0, 1, 2, 3]);
            // 0 = avail, 1 = unavail, 2 = temp unavail, 3 = unknown

            $table->foreign("employee_id")->references("id")->on("employees")->onDelete("cascade");
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
        Schema::dropIfExists('custom_schedules');
    }
}
