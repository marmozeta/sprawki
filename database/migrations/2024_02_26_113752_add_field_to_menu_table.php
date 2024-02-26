<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->integer('is_constant');
        });
        
        DB::statement("UPDATE menus SET ordinal_number = 9");
        DB::statement("UPDATE menus SET ordinal_number = 1 WHERE slug = 'sprawki'");
        DB::statement("UPDATE menus SET ordinal_number = 2 WHERE slug = 'rozprawki'");
        DB::statement("UPDATE menus SET ordinal_number = 3 WHERE slug = 'sklep'");
        DB::statement("UPDATE menus SET ordinal_number = 4 WHERE slug = 'polecamy'");
        DB::statement("UPDATE menus SET ordinal_number = 5 WHERE slug = 'spolecznosc'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('is_constant');
            
            DB::statement("UPDATE menus SET ordinal_number = 0");
        });
    }
};
