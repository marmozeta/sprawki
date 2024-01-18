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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('lastname')->after('user_id');
            $table->string('firstname')->after('user_id');
            $table->string('email')->after('user_id');
            $table->string('error')->after('payment_token');
            $table->string('status')->after('payment_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('error');
            $table->dropColumn('status');
            $table->dropColumn('lastname');
            $table->dropColumn('firstname');
            $table->dropColumn('email');
        });
    }
};
