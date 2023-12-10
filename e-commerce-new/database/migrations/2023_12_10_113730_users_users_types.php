<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_user_types', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')-> on ('users');
            $table->unsignedBigInteger('user_types_id');
            $table->foreign('user_types_id')->references('id')-> on ('user_types');
            $table->primary(['user_id', 'user_types_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_users_types');
    }
};
