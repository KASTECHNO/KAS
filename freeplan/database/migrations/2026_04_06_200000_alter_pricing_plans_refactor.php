<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // 1. Vider les anciennes données (structure incompatible)
        DB::table('pricing_plans')->truncate();

        Schema::table('pricing_plans', function (Blueprint $table) {
            // 2. Supprimer les anciennes colonnes de prix multiples
            $table->dropColumn(['abonnement_mensuel', 'abonnement_annuel', 'achat_total']);
        });

        Schema::table('pricing_plans', function (Blueprint $table) {
            // 3. Ajouter les nouvelles colonnes
            $table->enum('type', ['mensuel', 'annuel', 'licence'])
                  ->unique()
                  ->after('nom_application');
            $table->decimal('prix', 10, 2)->after('type');
        });
    }

    public function down(): void
    {
        Schema::table('pricing_plans', function (Blueprint $table) {
            $table->dropUnique(['type']);
            $table->dropColumn(['type', 'prix']);
            $table->decimal('abonnement_mensuel', 10, 2)->nullable();
            $table->decimal('abonnement_annuel',  10, 2)->nullable();
            $table->decimal('achat_total',         10, 2)->nullable();
        });
    }
};
