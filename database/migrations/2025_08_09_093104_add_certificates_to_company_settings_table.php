<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->json('certificates')->nullable()->after('social_links');
            $table->json('certificates_public_ids')->nullable()->after('certificates');
        });
    }

    public function down()
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->dropColumn(['certificates', 'certificates_public_ids']);
        });
    }
};
