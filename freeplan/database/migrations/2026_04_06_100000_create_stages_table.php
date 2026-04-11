<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->string('titre', 200);
            $table->string('slug', 220)->unique();
            $table->string('domaine', 100); // ex: Développement, IoT, IA
            $table->string('type_stage', 50)->default('PFE'); // PFE, Initiation, Perfectionnement
            $table->string('niveau_requis', 100)->nullable(); // Licence, Master, Ingénierie
            $table->text('description');
            $table->text('technologies')->nullable(); // technologies utilisées
            $table->date('date_limite')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stages');
    }
};
