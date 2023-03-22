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
        if (!Schema::hasTable('categoroy_discounts')) {
            Schema::create('categoroy_discounts', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->id();
                $table->unsignedBigInteger('category')->nullable()->comment('fk=>categories');
                $table->unsignedBigInteger('discount')->nullable()->comment('fk=>discounts');
                $table->index('category');
                $table->index('discount');                                                                
                $table->foreign('category')->references('id')->on('categories');
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
        Schema::dropIfExists('categoroy_discounts');
    }
};
