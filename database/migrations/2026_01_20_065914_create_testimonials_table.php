<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimonialsTable extends Migration
{public function up()
{
    Schema::create('testimonials', function (Blueprint $table) {
        $table->id();
        $table->string('client_name', 150);
        $table->string('client_role', 150)->nullable();
        $table->string('company')->nullable();
        $table->text('message');
        $table->string('avatar_url', 500)->nullable();
        $table->integer('display_order')->default(0);
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

}
