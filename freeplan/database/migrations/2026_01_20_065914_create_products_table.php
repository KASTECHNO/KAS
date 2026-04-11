<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->foreignId('sector_id')->constrained('activity_sectors');
        $table->string('name');
        $table->string('slug')->unique();
        $table->text('description')->nullable();
        $table->decimal('price', 10, 2)->nullable();
        $table->unsignedInteger('display_order')->default(0);
        $table->string('image_url', 500)->nullable();
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}



}
