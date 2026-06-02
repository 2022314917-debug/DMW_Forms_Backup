<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('request', 'uri_ng_tulong')) {


            Schema::table('request', function (Blueprint $table) {
                $table->text('uri_ng_tulong')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('request', 'uri_ng_tulong')) {


            Schema::table('request', function (Blueprint $table) {
                $table->string('uri_ng_tulong')->change();
            });
        }
    }
};