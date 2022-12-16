<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brutos', function (Blueprint $table) {
            $table->id();
            $table->integer('uid');
            $table->integer('user_id');
            $table->date('fecha');
            $table->string('hora');
            $table->integer('gestion');
            $table->integer('mes');
            $table->integer('dia');
            $table->integer('h');
            $table->integer('m');
            $table->integer('punch');
            $table->integer('rstatus');
            $table->string('lugar');
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
        Schema::dropIfExists('brutos');
    }
}
