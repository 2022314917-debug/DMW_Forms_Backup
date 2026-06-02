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
        Schema::table('request', function (Blueprint $table) {
            if(Schema::hasColumn('request', 'uri_ng_tulong')) {
                $table->dropColumn('uri_ng_tulong');
            }
            if(!Schema::hasColumn('request', 'uri_ng_tulong')){
                $table->string('uri_ng_tulong')->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
