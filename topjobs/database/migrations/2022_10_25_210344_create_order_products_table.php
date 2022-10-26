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
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); //make sure the field is NULLABLE 
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); //make sure the field is NULLABLE
            $table->foreignId('free_id')->constrained()->onDelete('cascade'); //make sure the field is NULLABLE
            $table->integer('free_qty');
            $table->integer('qty');
            $table->double('unit_price', 10,2)->default(0.00); 
            $table->double('amount', 10,2)->default(0.00); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_products');
    }
};
