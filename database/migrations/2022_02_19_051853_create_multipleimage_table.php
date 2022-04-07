<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultipleimageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multipleimage', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')->references('id')->on('product')->cascadeOnDelete();
            $table->string('image');
            $table->integer('sort');
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
        Schema::dropIfExists('multipleimage');
    }
}
