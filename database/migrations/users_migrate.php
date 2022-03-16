<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('userID');
            $table->string('name');
            $table->enum('role', ['ADMIN', 'INSTRUKTUR', 'MEMBER'])->default('MEMBER');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('badges')->nullable();
            $table->integer('levels')->default(0);
            $table->integer('points')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
};
