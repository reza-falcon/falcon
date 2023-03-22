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
        if (!Schema::hasTable('ratings')) {
            Schema::create('ratings', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->id();
                $table->integer('rate')->default(0);
                $table->unsignedBigInteger('user')->nullable()->comment('fk=>users');
                $table->unsignedBigInteger('product')->nullable()->comment('fk=>products');
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
        Schema::dropIfExists('ratings');
    }
};
