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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')
                ->constrained('division')
                ->cascadeOnDelete();
            $table->string('emp_lname');
            $table->string('emp_fname');
            $table->string('emp_ename')->nullable();
            $table->string('emp_mname')->nullable();
            $table->string('emp_gender');
            $table->date('emp_bday');
            $table->string('emp_email')->unique();
            $table->string('emp_password');
            $table->string('emp_contact_no');
            $table->string('emp_position');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
