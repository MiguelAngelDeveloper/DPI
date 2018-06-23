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
            $table->string('zone',3);
            $table->timestamps();
        });
        Schema::create('ads', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->string('name',20)->unique();
            $table->String('duration',8);
            $table->string('tipo',100);
            $table->string('code',11)->unique();
            $table->string('announcer',32);
            $table->timestamps();
        });
        Schema::create('windows', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->datetime('init_date');
            $table->integer('channel_id')->unsigned();
            $table->string('duration',5);
            $table->timestamps();
            $table->foreign('channel_id')->references('id')->on('channels')->onDelete('cascade');
        });
        Schema::create('breaks', function (Blueprint $table){
          $table->engine = 'InnoDB';
          $table->charset = 'utf8';
          $table->collation = 'utf8_unicode_ci';
          $table->increments('id');
          $table->string('optimal_insertion_date',8);
          $table->timestamps();

        });
        Schema::create('spot_insertion', function (Blueprint $table){
          $table->engine = 'InnoDB';
          $table->charset = 'utf8';
          $table->collation = 'utf8_unicode_ci';
          $table->increments('id');
          $table->integer('windows_id')->unsigned();
          $table->integer('break_id')->unsigned();
          $table->integer('break_position_in_window')->unsigned();
          $table->integer('ad_id')->unsigned()->nullable();
          $table->integer('ad_pos_in_break')->unsigned()->nullable();
          $table->string('event_type',3);
          $table->timestamps();
          $table->foreign('ad_id')->references('id')->on('ads')->onDelete('cascade');
          $table->foreign('break_id')->references('id')->on('breaks')->onDelete('cascade');
          $table->foreign('windows_id')->references('id')->on('windows')->onDelete('cascade');

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
        Schema::dropIfExists('spot_insertion');
        Schema::dropIfExists('breaks');
        Schema::dropIfExists('ads');
        Schema::dropIfExists('windows');
        Schema::dropIfExists('channels');

    }
}
