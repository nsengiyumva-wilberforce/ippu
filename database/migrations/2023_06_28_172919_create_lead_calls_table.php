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
        Schema::create('lead_calls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id')->index('lead_calls_lead_id_foreign');
            $table->string('subject');
            $table->string('call_type', 30);
            $table->string('duration', 20);
            $table->integer('user_id');
            $table->text('description')->nullable();
            $table->text('call_result')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_calls');
    }
};
