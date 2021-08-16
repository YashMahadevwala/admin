<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Students extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            // Schema::dropIfExists('students');
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('address');
            $table->date('dateofbirth');
            $table->integer('passingyear');
            $table->unsignedBigInteger('semester');
            $table->unsignedBigInteger('subjects');
            $table->integer('age');
            $table->text('avtar')->nullable();
            $table->timestamps();
            $table->foreign('semester')->references('id')->on('semester');
            $table->foreign('subjects')->references('id')->on('subjects');
            // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
