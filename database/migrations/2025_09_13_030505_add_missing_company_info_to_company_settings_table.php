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
        Schema::table('company_settings', function (Blueprint $table) {
            // Business license information
            $table->string('license_number')->nullable();
            $table->string('license_authority')->nullable();
            $table->date('license_date')->nullable();
            
            // Asset paths
            $table->string('logo_main')->nullable();
            $table->string('logo_favicon')->nullable();
            $table->string('logo_footer')->nullable();
            
            // Map information for second location
            $table->json('google_map_2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->dropColumn([
                'license_number',
                'license_authority', 
                'license_date',
                'logo_main',
                'logo_favicon',
                'logo_footer',
                'google_map_2',
            ]);
        });
    }
};
