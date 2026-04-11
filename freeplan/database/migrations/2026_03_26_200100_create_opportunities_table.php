<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->nullable()->constrained('leads')->nullOnDelete();
            $table->foreignId('client_id')->nullable()->constrained('clients')->nullOnDelete();
            $table->string('name', 180);
            $table->decimal('amount', 14, 2)->default(0);
            $table->string('currency', 3)->default('EUR');
            $table->string('stage', 30)->default('DISCOVERY')->index();
            $table->unsignedTinyInteger('probability')->default(20);
            $table->date('expected_close_date')->nullable();
            $table->string('status', 20)->default('OPEN')->index();
            $table->foreignId('owner_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opportunities');
    }
};
