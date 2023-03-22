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
        if (!Schema::hasTable('product_discounts')) {
            Schema::create('product_discounts', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->id();
                $table->unsignedBigInteger('product')->nullable()->comment('fk=>products');
                $table->unsignedBigInteger('discount')->nullable()->comment('fk=>discounts');
                $table->index('product');
                $table->index('discount');
                $table->foreign('product')->references('id')->on('products');
                $table->foreign('discount')->references('id')->on('discounts');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_discounts');
    }
};
