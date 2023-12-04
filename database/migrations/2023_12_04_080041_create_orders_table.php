<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('order_status')->default(0);
            $table->string('order_date');
            $table->string('required_date');
            $table->string('shipped_date');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('staff_id');
            $table->timestamps();
            $table->foreign('customer_id')
              ->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('store_id')
              ->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('staff_id')
              ->references('id')->on('staff')->onDelete('cascade');
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
