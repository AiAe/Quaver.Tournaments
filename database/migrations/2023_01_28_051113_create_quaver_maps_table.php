<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('quaver_maps', function (Blueprint $table) {
            $table->id('quaver_map_id');

            $table->unsignedBigInteger('quaver_mapset_id');
            $table->unsignedBigInteger('quaver_creator_id');
            $table->string('creator_username');
            $table->integer('game_mode');
            $table->integer('ranked_status');
            $table->string('artist');
            $table->string('title');
            $table->string('difficulty_name');
            $table->integer('length');
            $table->float('bpm');
            $table->float('difficulty_rating');
            $table->integer('count_hitobject_normal');
            $table->integer('count_hitobject_long');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quaver_maps');
    }
};
