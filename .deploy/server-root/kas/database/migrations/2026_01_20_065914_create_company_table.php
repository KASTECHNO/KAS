<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{public function up()
{
    Schema::create('company', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slogan')->nullable();
        $table->text('description')->nullable();
        $table->string('address')->nullable();
        $table->string('email')->nullable();
        $table->string('phone', 50)->nullable();
        $table->string('website_url')->nullable();
        $table->string('logo_url', 500)->nullable();
        $table->timestamps();
    });
}


}
