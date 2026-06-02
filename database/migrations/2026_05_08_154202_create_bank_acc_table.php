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
        Schema::create('bank_acc_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('request')->onDelete('cascade');
            $table->string('bank_name')->nullable()->change();
            $table->string('bank_branch')->nullable()->change();
            $table->string('bank_acc_num')->nullable()->change();
            $table->string('bank_acc_name')->nullable()->change();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bank_acc_details', function (Blueprint $table) {
            $table->string('bank_name')->nullable(false)->change();
            $table->string('bank_branch')->nullable(false)->change();
            $table->string('bank_acc_num')->nullable(false)->change();
            $table->string('bank_acc_name')->nullable(false)->change();
        });
    }
};
