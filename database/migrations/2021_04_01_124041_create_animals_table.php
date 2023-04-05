<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('owner_id')->unsigned();
            $table->bigInteger('sitter_id')->unsigned()->nullable();
            $table->string('name');
            $table->longText('image');
            $table->string('animal');
            $table->string('breed');
            $table->date('date');
            $table->string('time');
            $table->double('hourly_rate', 19, 2);
            $table->longText('description');

            $table->foreign('owner_id')->references('id')->on('users');
            $table->foreign('sitter_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
}
