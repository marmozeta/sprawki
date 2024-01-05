<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Element;
use App\Models\Tag;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::rename('categories', 'tags');
        
        Schema::table('tags', function (Blueprint $table) {
                $table->renameColumn('cat_id', 'tag_id');
        });
        
        Schema::table('element_categories', function (Blueprint $table) {
            $table->dropColumn(['category_cat_id']);
        });

        Schema::rename('element_categories', 'element_tags');

        Schema::table('element_tags', function (Blueprint $table) {
            $table->foreignIdFor(Tag::class);
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
