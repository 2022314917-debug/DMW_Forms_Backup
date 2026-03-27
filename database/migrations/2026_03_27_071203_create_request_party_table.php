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
        Schema::create('request_party', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')
                ->constrained('request')
                ->cascadeOnDelete();
            $table->string('party_lname');
            $table->string('party_fname');
            $table->string('party_ename')->nullable();
            $table->string('party_mname')->nullable();
            $table->string('party_email');
            $table->date('party_bday');
            $table->string('party_gender');
            $table->string('party_relationship');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_party');
    }
};
