<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StageCandidature extends Model
{
    protected $fillable = [
        'stage_id',
        'nom',
        'email',
        'phone',
        'etablissement',
        'niveau_etudes',
        'specialite',
        'lettre_motivation',
        'cv_path',
        'statut',
        'notes_admin',
    ];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public static function statutLabels(): array
    {
        return [
            'RECU'     => 'Reçue',
            'EN_COURS' => 'En cours d\'examen',
            'ACCEPTE'  => 'Acceptée',
            'REFUSE'   => 'Refusée',
        ];
    }

    public function statutLabel(): string
    {
        return self::statutLabels()[$this->statut] ?? $this->statut;
    }
}
