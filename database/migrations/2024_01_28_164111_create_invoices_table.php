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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('bill_from');
            $table->string('bill_to');
            $table->string('ship_to')->nullable();
            $table->date('date')->default(now());
            $table->string('payment_type');
            $table->date('due_date')->default(now());
            $table->integer('po_number');
            $table->string('notes')->nullable();
            $table->string('terms')->nullable();
            $table->double('sub_total');
            $table->double('discount')->default(0);
            $table->double('tax')->default(0);
            $table->double('shipping')->default(0);
            $table->double('total');
            $table->double('paid_amount')->default(0);
            $table->double('due_amount');
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
