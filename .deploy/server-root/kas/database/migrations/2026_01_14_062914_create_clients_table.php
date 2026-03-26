<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
{
    Schema::create('clients', function (Blueprint $table) {
        $table->id();
        $table->foreignId('sector_id')->nullable()->constrained('activity_sectors');
        $table->string('name');
        $table->string('logo_url', 500)->nullable();
        $table->string('website_url')->nullable();
        $table->text('description')->nullable();
        $table->timestamps();
    });
}

}
