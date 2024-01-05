<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Element;
use App\Models\Category;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('element_types');
         
        Schema::create('categories', function (Blueprint $table) {
            $table->id('cat_id');
            $table->string('name');
            $table->integer('active');
            $table->timestamps();
        });
        
        Schema::create('element_categories', function (Blueprint $table) {       
            $table->foreignIdFor(Element::class);
            $table->foreignIdFor(Category::class);
            $table->timestamps();
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
