<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // wag mo muna pansinin to
    public function up(): void
    {
        Schema::create('processing_requests', function (Blueprint $table) {
            $table->id();
            $table->string('ofw_family_name')->nullable();
            $table->string('ofw_first_name')->nullable();
            $table->string('ofw_middle_name')->nullable();
            $table->string('jobsite')->nullable();
            $table->string('record_year')->nullable();
            $table->string('purpose')->nullable();
            $table->string('agency_name')->nullable();
            $table->string('req_family_name')->nullable();
            $table->string('req_first_name')->nullable();
            $table->string('req_middle_name')->nullable();
            $table->string('relationship_ofw')->nullable();
            $table->string('contact_number')->nullable();
            $table->text('phil_address')->nullable();
            $table->string('province')->nullable();
            $table->string('municipality')->nullable();
            $table->string('barangay')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('telephone_number')->nullable();
            $table->string('email_address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('processing_requests');
    }
};
