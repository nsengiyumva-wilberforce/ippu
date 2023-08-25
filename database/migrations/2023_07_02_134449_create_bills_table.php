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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('bill_id')->default('0');
            $table->integer('vender_id');
            $table->date('bill_date');
            $table->date('due_date');
            $table->integer('order_number')->default(0);
            $table->integer('status')->default(0);
            $table->integer('shipping_display')->default(1);
            $table->date('send_date')->nullable();
            $table->integer('discount_apply')->default(0);
            $table->integer('category_id');
            $table->integer('created_by')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
