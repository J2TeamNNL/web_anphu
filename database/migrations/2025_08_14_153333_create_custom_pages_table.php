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
        Schema::create('custom_pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // vd: about-anphu, voucher
            $table->string('title_1')->nullable();
            $table->string('title_2')->nullable();
            $table->string('title_3')->nullable();
            $table->string('title_4')->nullable();

            $table->string('image_1')->nullable();
            $table->string('image_1_public_id')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_2_public_id')->nullable();
            $table->string('image_3')->nullable();
            $table->string('image_3_public_id')->nullable();
            $table->string('image_4')->nullable();
            $table->string('image_4_public_id')->nullable();

            $table->longText('custom_content_1')->nullable();
            $table->longText('custom_content_2')->nullable();
            $table->longText('custom_content_3')->nullable();
            $table->longText('custom_content_4')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_pages');
    }
};
