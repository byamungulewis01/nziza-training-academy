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
        Schema::create('monthly_goals_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('monthly_goal_id')->constrained('monthly_goals')->cascadeOnDelete();
            $table->enum('type',['license', 'training']);
            $table->integer('quality');
            $table->bigInteger('revenue');
            $table->bigInteger('achieves_revenue')->default(0);
            $table->string('client_name');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_goals_lists');
    }
};
