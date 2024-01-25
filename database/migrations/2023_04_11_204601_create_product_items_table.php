<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_items', function (Blueprint $table) {
            $table->id();
            $table->string('serial_no')->nullable();
            $table->foreignId('invoice_id')->nullable()->constrained('invoices');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('employee_id')->nullable()->constrained('employees');
            $table->foreignId('variation_id')->nullable()->constrained('variations');
            $table->foreignId('department_id')->nullable()->constrained('departments');
            $table->double('price');
            $table->json('meta')->nullable();
            $table->timestamps();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_items');
    }
};
