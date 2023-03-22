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
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->id();
                $table->string('title')->nullable();
                $table->string('description', 500)->nullable();
                $table->string('serial_number')->nullable();
                $table->unsignedBigInteger('stock')->default(0);
                $table->double('price', 10, 2)->default(0.00);
                $table->unsignedBigInteger('category')->nullable()->comment('fk=>categories');
                $table->index('category');
                $table->unsignedBigInteger('sub_category')->nullable()->comment('fk=>sub_categories');
                $table->index('sub_category');
                $table->foreign('category')->references('id')->on('categories');
                $table->foreign('sub_category')->references('id')->on('sub_categories');
                $table->enum('status', ['active', 'disable'])->default('active');
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
        Schema::dropIfExists('products');
    }
};
