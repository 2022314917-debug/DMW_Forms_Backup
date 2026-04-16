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
        Schema::create('request_ofw', function (Blueprint $table) {
            $table->id();

            $table->foreignId('request_id')
                ->constrained('request')
                ->cascadeOnDelete();

            $table->string('ofw_lname');
            $table->string('ofw_fname');
            $table->string('ofw_ename')->nullable();
            $table->string('ofw_mname')->nullable();
            $table->string('ofw_passport_no');
            $table->string('ofw_gender');
            $table->string('ofw_civil_status');
            $table->string('ofw_email');
            $table->string('ofw_phone');
            $table->date('ofw_bday');
            $table->string('ofw_country');
            $table->string('ofw_job');
            $table->string('ofw_employer');
            $table->string('ofw_agency');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_ofw');
    }
};
