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
        Schema::create('elpor_startup_equipment_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')
                ->constrained('request')
                ->cascadeOnDelete();
            $table->string('supplier_name');
            $table->string('item_name');
            $table->decimal('item_price', 10, 2);
            $table->integer('item_qty');
            $table->decimal('item_total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elpor_startup_equipment_products');
    }
};
