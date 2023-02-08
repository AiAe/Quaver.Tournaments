<?php

use App\Models\Tournament;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tournament_staff', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Tournament::class)->constrained()->cascadeOnDelete();
            $table->integer('staff_role');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tournament_staff');
    }
};
