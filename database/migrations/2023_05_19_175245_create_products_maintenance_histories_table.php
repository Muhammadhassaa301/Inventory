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

        /*
        product_item_id - foregin id constrained to product_items table.
        title - type string nullable
        description - type text nullable
        amount - type double defaults to zero
        meta - type json nullable
        timestamps
        created_by  - foregin id constrained to users nullable
        updated_by - foreign id constrained to users nullable
        */

    public function up()
    {
        Schema::create('products_maintenance_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_item_id')->constrained('product_items');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->double('amount')->default(0);
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
        Schema::dropIfExists('products_maintenance_histories');        
    }
};

