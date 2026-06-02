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
        Schema::create('elpor_ofw_training_record', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')
                ->constrained('request')
                ->cascadeOnDelete();
            $table->string('training_name');
            $table->string('venue');
            $table->string('issued_by');
            $table->date('training_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elpor_ofw_training_record');
    }
};
