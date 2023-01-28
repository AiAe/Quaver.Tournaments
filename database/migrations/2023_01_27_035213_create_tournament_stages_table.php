<?php

use App\Models\Tournament;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tournament_stages', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->foreignIdFor(Tournament::class)->constrained()->cascadeOnDelete();
            $table->unsignedInteger('index');
            $table->unsignedInteger('stage_format');

            $table->unique(['tournament_id', 'index']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tournament_stages');
    }
};
