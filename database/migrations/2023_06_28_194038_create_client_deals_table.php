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
        Schema::create('client_deals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->index('client_deals_client_id_foreign');
            $table->unsignedBigInteger('deal_id')->index('client_deals_deal_id_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_deals');
    }
};
