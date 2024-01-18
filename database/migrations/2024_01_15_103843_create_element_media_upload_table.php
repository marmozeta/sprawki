<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\MediaUpload;
use App\Models\Element;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('element_media_upload', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Element::class);
            $table->foreignIdFor(MediaUpload::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('element_media_upload');
    }
};
