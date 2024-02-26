<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->enum('branch', ['rwanda', 'tanzania']);
            $table->string('invoice_no')->unique();
            $table->string('salesperson');
            $table->string('address');
            $table->string('valid_date');
            $table->string('expired_date');
            $table->string('training')->nullable();
            $table->string('training_qty')->nullable();
            $table->string('training_discount')->nullable();
            $table->string('licence')->nullable();
            $table->string('licence_qty')->nullable();
            $table->string('licence_discount')->nullable();
            $table->decimal('total');
            $table->text('notes');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
