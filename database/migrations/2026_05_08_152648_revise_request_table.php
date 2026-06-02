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
            if (Schema::hasColumn('request', 'nature_of_request')) {
                $table->renameColumn('nature_of_request', 'uri_ng_tulong');
            }
            if (Schema::hasColumn('request', 'form_step')) {
                $table->dropColumn('form_step');
            }
            $table->string('maikling_salaysay')->after('uri_ng_tulong');
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
