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

                if (!Schema::hasColumn('request_ofw', 'ofw_fb_acc')) {
                    $table->string('ofw_fb_acc')->after('ofw_bday');
                }
                if (!Schema::hasColumn('request_ofw', 'ofw_fb_acc')) {
                    $table->string('ofw_address_abroad')->after('ofw_fb_acc');
                }

                if (Schema::hasColumn('request_ofw', 'ofw_job')) {
                     $table->dropColumn('ofw_job');
                }
                if (Schema::hasColumn('request_ofw', 'ofw_country')) {      
                    $table->dropColumn('ofw_country');
                }
                if (Schema::hasColumn('request_ofw', 'ofw_employer')) {
                    $table->dropColumn('ofw_employer');
                }
                if (Schema::hasColumn('request_ofw', 'ofw_agency')) {
                    $table->dropColumn('ofw_agency');
                }
                
                
                
                
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('request_ofw', function (Blueprint $table) {
                $table->dropColumn('ofw_job');
                $table->dropColumn('ofw_country');
                $table->dropColumn('ofw_employer');
                $table->dropColumn('ofw_agency');
        });
    }
};
