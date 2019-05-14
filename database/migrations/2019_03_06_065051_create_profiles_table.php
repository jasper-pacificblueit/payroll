<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->integer('user_id')->unsigned(); 

            $table->text('about')->nullable();
            $table->boolean('gender');
            $table->string('fname');
            $table->string('lname');
            $table->string('mname');
            $table->date('birthdate');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // image
        DB::statement("alter table profiles add image mediumblob");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
