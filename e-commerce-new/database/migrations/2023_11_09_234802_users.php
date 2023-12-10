<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name',255);
            $table->integer('phone_number');
            $table->string('email');
            $table->string('username');
            $table->string('password');            
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
