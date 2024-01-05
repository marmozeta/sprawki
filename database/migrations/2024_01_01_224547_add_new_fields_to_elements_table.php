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
        Schema::table('elements', function (Blueprint $table) {
            $table->string('author');
            $table->float('price');
            $table->float('vat');
            $table->integer('stock_quantity');
            $table->float('discount');
            $table->integer('in_sale');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('elements', function (Blueprint $table) {
            $table->dropColumn('author');
            $table->dropColumn('price');
            $table->dropColumn('vat');
            $table->dropColumn('stock_quantity');
            $table->dropColumn('discount');
            $table->dropColumn('in_sale');
        });
    }
};
