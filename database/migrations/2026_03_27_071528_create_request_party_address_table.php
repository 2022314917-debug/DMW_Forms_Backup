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
        Schema::create('request_party_address', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')
                ->constrained('request')
                ->cascadeOnDelete();
            $table->foreignId('request_party_id')
                ->constrained('request_party')
                ->cascadeOnDelete();
            $table->string('province');
            $table->string('municipality');
            $table->string('brgy');
            $table->string('house_no');
            $table->string('zip_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_party_address');
    }
};
