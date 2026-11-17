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
        Schema::create('blood_collections', function (Blueprint $table) {
            $table->id();
            $table->string('title', 120);
            $table->string('location', 180);
            $table->string('address', 255)->nullable();
            $table->dateTime('starts_at')->index();
            $table->dateTime('notification_at')->nullable()->index();
            $table->timestamp('notifications_queued_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_collections');
    }
};
