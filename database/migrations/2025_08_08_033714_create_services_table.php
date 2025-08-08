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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slogan')->nullable(); // Thêm trường slogan
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('image_public_id')->nullable();
            
            $table->string('title_1')->nullable();
            $table->string('icon_1')->nullable();
            $table->string('icon_1_public_id')->nullable();
            $table->text('content_1')->nullable();

            $table->string('title_2')->nullable();
            $table->string('icon_2')->nullable();
            $table->string('icon_2_public_id')->nullable();
            $table->text('content_2')->nullable();

            $table->string('title_3')->nullable();
            $table->string('icon_3')->nullable();
            $table->string('icon_3_public_id')->nullable();
            $table->text('content_3')->nullable();

            $table->string('title_4')->nullable();
            $table->string('icon_4')->nullable();
            $table->string('icon_4_public_id')->nullable();
            $table->text('content_4')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
