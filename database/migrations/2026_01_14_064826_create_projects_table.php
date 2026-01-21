<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->foreignId('sector_id')->nullable()->constrained('activity_sectors');
        $table->foreignId('client_id')->nullable()->constrained('clients');
        $table->string('title');
        $table->string('slug')->unique();
        $table->string('short_desc', 500)->nullable();
        $table->text('description')->nullable();
        $table->date('start_date')->nullable();
        $table->date('end_date')->nullable();
        $table->string('main_image_url', 500)->nullable();
        $table->boolean('is_featured')->default(false);
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
        Schema::dropIfExists('projects');
    }
}
