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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255)->nullable();
            $table->string("material", 60)->nullable();
            $table->string("color")->nullable();
            $table->string("image", 255)->nullable();
            $table->decimal("price", 6,2);
            $table->biginteger('brand_id')->unsigned();
            $table->foreign('brand_id')->reference('id')->on('brands');
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
        Schema::dropIfExists('products');
    }
};
