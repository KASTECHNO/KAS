<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactMessagesTable extends Migration
{public function up()
{
    Schema::create('contact_messages', function (Blueprint $table) {
        $table->id();
        $table->string('fullname', 150);
        $table->string('email');
        $table->string('phone', 50)->nullable();
        $table->string('subject')->nullable();
        $table->text('message');
        $table->enum('status', ['NEW','IN_PROGRESS','CLOSED'])->default('NEW');
        $table->timestamps();
    });
}

}
