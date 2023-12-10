<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')-> on ('users');
            $table->unsignedBigInteger('order_item_id');
            $table->foreign('order_item_id')->references('id')-> on ('orderItems');
            $table->timestamp('order_date')->useCurrent();
            $table->string('status');
            $table->timestamps();

        });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
