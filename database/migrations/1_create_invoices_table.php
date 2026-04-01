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
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->foreign('manager_id')->references('id')->on('users');

            $table->string('invoice_number')->unique();
            $table->integer('installment_number');
            $table->decimal('additional_amount', 15, 2);
            $table->decimal('total_amount', 15, 2);
            $table->enum('status', ['Unpaid', 'Partial', 'Paid'])->default('Unpaid');
            $table->timestamp('date');
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
