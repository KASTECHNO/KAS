<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pricing_plans', function (Blueprint $table) {
            $table->id();
            $table->string('nom_application', 200);   // Nom de l'application / produit
            $table->text('description')->nullable();
            $table->decimal('abonnement_mensuel', 10, 2)->nullable();  // prix/mois
            $table->decimal('abonnement_annuel', 10, 2)->nullable();   // prix/an
            $table->decimal('achat_total', 10, 2)->nullable();         // achat unique
            $table->text('fonctionnalites')->nullable();  // liste, une par ligne
            $table->string('badge', 80)->nullable();      // ex: "Populaire", "Recommandé"
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pricing_plans');
    }
};
