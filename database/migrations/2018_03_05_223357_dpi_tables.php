<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DpiTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('channels', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->string('name',100)->unique();
            $table->string('code',2);
            $table->char('zone',3);
            $table->timestamps();
        });
        Schema::create('ads', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->string('name',100);
            $table->String('duration',5);
            $table->string('tipo',100);
            $table->string('code',11);
            $table->string('announcer',20);
            $table->timestamps();
        });
        Schema::create('breaks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->datetime('init_date');
            $table->integer('channel_id')->unsigned();
            $table->string('duration',5);
            $table->timestamps();
            $table->foreign('channel_id')->references('id')->on('channels');
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
        Schema::dropIfExists('ads');
        Schema::dropIfExists('breaks');
        Schema::dropIfExists('channels');
    }
}
