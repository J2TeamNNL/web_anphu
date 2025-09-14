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
        Schema::table('consulting_requests', function (Blueprint $table) {
            $table->text('requirements')->nullable()->after('note'); // Nhu cầu (Diện tích đất, số tầng,...)
            
            $table->string('location')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consulting_requests', function (Blueprint $table) {
            $table->dropColumn(['address', 'requirements']);
        });
    }
};
