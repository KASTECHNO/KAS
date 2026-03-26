<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('quotes', function (Blueprint $table) {
            $table->id(); // id BIGINT auto-increment
            $table->string('fullname', 150); // VARCHAR(150)
            $table->string('email', 255); // VARCHAR(255)
            $table->string('phone', 50)->nullable(); // VARCHAR(50) nullable
            $table->text('message')->nullable(); // TEXT nullable
            $table->foreignId('service_id')->constrained()->onDelete('cascade'); // BIGINT + foreign key
            $table->foreignId('project_id')->constrained()->onDelete('cascade'); // BIGINT + foreign key
            $table->enum('status', ['NEW', 'IN_PROGRESS', 'SENT', 'ACCEPTED', 'REJECTED'])->default('NEW'); // ENUM
            $table->timestamps(); // created_at et updated_at
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
