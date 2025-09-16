<?php

use App\Models\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'slug')->unique(indexName: 'slug');
            // $table->unsignedBigInteger('parent_id')->nullable();
            // $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade'); //old code
            $table->foreignIdFor(Category::class, column: 'parent_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('image')->nullable();
            $table->string('desc_ar')->nullable();
            $table->string('desc_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
