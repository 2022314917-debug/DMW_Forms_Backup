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
        Schema::table('request_ofw', function (Blueprint $table) {
            if (!Schema::hasColumn('request_ofw', 'ofw_agency')) {
                $table->string('ofw_agency')->after('ofw_employer');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('request_ofw', function (Blueprint $table) {
            if (Schema::hasColumn('request_ofw', 'ofw_agency')) {
                $table->dropColumn('ofw_agency');
            }
        });
    }
};
