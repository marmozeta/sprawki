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
        Schema::table('menus', function (Blueprint $table) {
            $table->integer('linked_elements');
            $table->integer('has_likes');
            $table->integer('has_comments');
            $table->integer('has_arguments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('linked_elements');
            $table->dropColumn('has_likes');
            $table->dropColumn('has_comments');
            $table->dropColumn('has_arguments');
        });
    }
};
