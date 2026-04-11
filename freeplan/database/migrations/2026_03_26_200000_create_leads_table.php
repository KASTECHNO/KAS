<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('source', 50)->default('WEBSITE_CONTACT');
            $table->string('fullname', 150);
            $table->string('email', 255)->nullable()->index();
            $table->string('phone', 50)->nullable();
            $table->string('company', 255)->nullable();
            $table->foreignId('sector_id')->nullable()->constrained('activity_sectors')->nullOnDelete();
            $table->string('status', 30)->default('NEW')->index();
            $table->unsignedTinyInteger('score')->default(0);
            $table->text('notes')->nullable();
            $table->foreignId('owner_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('converted_client_id')->nullable()->constrained('clients')->nullOnDelete();
            $table->timestamp('last_contact_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
