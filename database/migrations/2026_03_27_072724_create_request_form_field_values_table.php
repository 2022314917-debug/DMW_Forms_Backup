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
        Schema::create('request_form_field_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_form_entry_id')
                ->constrained('request_form_entries')
                ->cascadeOnDelete();
            $table->foreignId('request_form_field_id')
                ->constrained('request_form_field')
                ->cascadeOnDelete();
            $table->string('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_form_field_values');
    }
};
