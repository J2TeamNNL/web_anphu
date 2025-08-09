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
            $table->date('established_date')->nullable()->after('id');
            $table->string('tax_code', 50)->nullable()->after('established_date');
        });
    }

    public function down()
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->dropColumn(['established_date', 'tax_code']);
        });
    }
};
