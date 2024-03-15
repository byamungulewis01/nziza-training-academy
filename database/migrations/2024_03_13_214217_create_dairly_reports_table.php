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
        Schema::create('dairly_reports', function (Blueprint $table) {
            $table->id();
            $table->text('beforenoon')->nullable();
            $table->text('afternoon')->nullable();
            $table->foreignId('reported_by')->constrained('users')->restrictOnDelete();
            $table->text('comment')->nullable();
            $table->timestamp('commented_at')->nullable();
            $table->foreignId('commented_by')->nullable()->constrained('users')->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dairly_reports');
    }
};
