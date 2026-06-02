<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('region_id')->constrained()->onDelete('cascade');
            $table->foreignId('destination_type_id')->constrained()->onDelete('cascade');
            $table->text('description');
            $table->text('tips')->nullable(); // gợi ý tham quan
            $table->string('address')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('image')->nullable();
            $table->json('gallery')->nullable(); // nhiều ảnh
            $table->integer('popularity')->default(0); // lượt xem
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
