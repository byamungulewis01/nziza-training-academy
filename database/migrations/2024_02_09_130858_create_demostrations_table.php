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
        Schema::create('demostrations', function (Blueprint $table) {
            $table->id();
            $table->string('topic');
            $table->string('email');
            $table->string('phone');
            $table->string('company_name');
            $table->string('suggest_date');
            $table->longText('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demostrations');
    }
};
