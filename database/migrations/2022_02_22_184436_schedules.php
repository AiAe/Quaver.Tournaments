<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Schedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('match_id')->index()->unique();

            $table->string('playerRed')->nullable()->default(null);
            $table->string('playerBlue')->nullable()->default(null);
            $table->string('playerRedScore')->nullable()->default(null);
            $table->string('playerBlueScore')->nullable()->default(null);

            $table->string('referee')->nullable()->default(null);
            $table->string('streamer')->nullable()->default(null);
            $table->string('comm1')->nullable()->default(null);
            $table->string('comm2')->nullable()->default(null);

            $table->timestamp('timestamp')->nullable()->default(null);

            $table->tinyInteger('played')->default(0)->nullable();
            $table->tinyInteger('notified')->default(0)->nullable();

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
