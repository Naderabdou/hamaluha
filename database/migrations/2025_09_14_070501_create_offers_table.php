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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->onDelete('cascade');
            $table->text('desc_ar')->nullable();
            $table->text('desc_en')->nullable();
            $table->decimal('discount')->nullable();
            $table->string(('image'))->nullable();
            $table->enum('type', ['offer', 'discount'])->default('discount');
            $table->boolean('is_active')->default(true);
            $table->timestamp(('start_at'))->nullable();
            $table->timestamp(('end_at'))->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
