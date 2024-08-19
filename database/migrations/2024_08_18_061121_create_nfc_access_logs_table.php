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
        Schema::create('nfc_access_logs', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->integer('counter');
            $table->ipAddress('ip_address');
            $table->enum('status', ['success', 'denied']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nfc_access_logs');
    }
};
