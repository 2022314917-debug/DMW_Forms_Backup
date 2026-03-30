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
        Schema::table('request_party', function (Blueprint $table) {
            if (!Schema::hasColumn('request_party', 'party_phone')) {
                $table->string('party_phone')->after('party_email');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('request_party', function (Blueprint $table) {
            if (Schema::hasColumn('request_party', 'party_phone')) {
                $table->dropColumn('party_phone');
            }
        });
    }
};
