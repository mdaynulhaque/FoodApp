<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_items', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->integer('cat_id')->nullable();
            $table->string('item_name');
            $table->text('description');
            $table->integer('price');
            $table->string('image');
            $table->string('image2');
            $table->string('image3');
            $table->string('image_small');
            $table->string('image2_small');
            $table->string('image3_small');
            $table->integer('status')->default(0);
            $table->integer('offer_price')->nullable();
            $table->integer('restu_id')->unsigned();
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
        Schema::dropIfExists('food_items');
    }
}
