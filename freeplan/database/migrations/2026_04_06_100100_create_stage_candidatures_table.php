<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stage_candidatures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stage_id')->constrained('stages')->cascadeOnDelete();
            $table->string('nom', 150);
            $table->string('email', 255);
            $table->string('phone', 50)->nullable();
            $table->string('etablissement', 200)->nullable();
            $table->string('niveau_etudes', 100)->nullable(); // Licence, Master, Ingénierie
            $table->string('specialite', 150)->nullable();
            $table->text('lettre_motivation')->nullable();
            $table->string('cv_path', 500)->nullable(); // path vers le CV uploadé
            $table->string('statut', 30)->default('RECU'); // RECU, EN_COURS, ACCEPTE, REFUSE
            $table->text('notes_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stage_candidatures');
    }
};
