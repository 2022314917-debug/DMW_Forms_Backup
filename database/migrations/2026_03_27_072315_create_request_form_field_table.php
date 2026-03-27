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
        Schema::create('request_form_field', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_form_id')
                ->constrained('request_form')
                ->cascadeOnDelete();
            $table->integer('parent_id')->nullable();
            $table->string('field_name');
            $table->string('field_label');
            $table->string('field_type');
            $table->string('option_group')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_form_field');
    }
};
