<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('file_path', 255);
            $table->string('url')->nullable();
            $table->string('public_id')->nullable();

            $table->enum('type', ['image', 'video'])->default('image');
            $table->string('caption')->nullable();
            $table->integer('order')->default(0);

            $table->unsignedBigInteger('mediaable_id')->nullable();
            $table->string('mediaable_type')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
}