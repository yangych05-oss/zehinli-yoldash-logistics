<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('company')->nullable();
            $table->string('email')->index();
            $table->string('phone');
            $table->string('origin');
            $table->string('destination');
            $table->text('cargo_details');
            $table->string('status')->default('new');
            $table->string('locale', 2)->default('ru');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
