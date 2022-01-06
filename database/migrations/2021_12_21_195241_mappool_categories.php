<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MappoolCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mappool_rounds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('position');
            $table->timestamps();
        });

        Schema::create('mappools', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('mappool_round_id')->index();
            $table->string('category');
            $table->string('type');
            $table->json('map');
            $table->json('data');
            $table->integer('position');

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
        //
    }
}
