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
        Schema::create('frees', function (Blueprint $table) {
            $table->id();
            $table->string('label'); 
            $table->string('type'); 
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); //make sure the field is NULLABLE
            $table->integer('free_qty');
            $table->integer('lower_limit');
            $table->integer('upper_limit');
            $table->string('status')->default('Active');
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
        Schema::dropIfExists('frees');
    }
};
