<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{


    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('articles', function (Blueprint $table) {
        $table->id();
        $table->string('productImage')->nullable();
        $table->string('name');
        $table->integer('price');
        $table->integer('stock');
        $table->string('company');
        $table->text('detail')->nullable();
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
        Schema::dropIfExists('articles');
    }
};
