<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('shipments', function (Blueprint $table): void {
            $table->string('tracking_code')->nullable()->unique()->after('tracking_number');
            $table->string('public_access_code')->nullable()->after('tracking_code');
        });
    }

    public function down(): void
    {
        Schema::table('shipments', function (Blueprint $table): void {
            $table->dropColumn(['tracking_code', 'public_access_code']);
        });
    }
};
