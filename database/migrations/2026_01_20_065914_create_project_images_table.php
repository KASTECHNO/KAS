<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectImagesTable extends Migration
{public function up()
{
    Schema::create('project_images', function (Blueprint $table) {
        $table->id();
        $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
        $table->string('image_url', 500);
        $table->string('caption')->nullable();
        $table->integer('display_order')->default(0);
        $table->timestamps();
    });
}

}
