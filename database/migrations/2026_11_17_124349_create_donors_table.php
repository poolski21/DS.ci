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
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('phone', 10)->unique();
            $table->string('email')->nullable();
            $table->string('preferred_channel', 20);
            $table->string('location', 180);
            $table->text('blood_group')->nullable();
            $table->timestamp('consent_at');
            $table->string('consent_version', 20);
            $table->text('screening_data');
            $table->text('eligibility_result');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donors');
    }
};
