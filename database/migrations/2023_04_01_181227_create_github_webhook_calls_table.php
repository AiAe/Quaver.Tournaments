<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('github_webhook_calls', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('url');
            $table->string('name');
            $table->json('headers')->nullable();
            $table->json('payload')->nullable();
            $table->text('exception')->nullable();

            $table->timestamps();
        });
    }
};
