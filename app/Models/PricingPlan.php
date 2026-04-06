<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    protected $fillable = [
        'nom_application',
        'type',
        'prix',
        'description',
        'fonctionnalites',
        'badge',
        'is_featured',
        'is_active',
        'display_order',
    ];

    protected $casts = [
        'prix'        => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
    ];

    /** Ordre d'affichage naturel des types. */
    public const TYPE_ORDER = ['mensuel' => 1, 'annuel' => 2, 'licence' => 3];

    /** Label public du type. */
    public function typeLabel(): string
    {
        return match($this->type) {
            'mensuel'  => 'Abonnement Mensuel',
            'annuel'   => 'Abonnement Annuel',
            'licence'  => 'Licence Perpétuelle',
            default    => ucfirst($this->type),
        };
    }

    /** Unité affichée après le prix. */
    public function prixPeriode(): string
    {
        return match($this->type) {
            'mensuel' => '/ mois',
            'annuel'  => '/ an',
            'licence' => 'licence unique',
            default   => '',
        };
    }

    /** Icône Font Awesome du type. */
    public function icone(): string
    {
        return match($this->type) {
            'mensuel' => 'fa-solid fa-calendar-day',
            'annuel'  => 'fa-solid fa-calendar-check',
            'licence' => 'fa-solid fa-server',
            default   => 'fa-solid fa-tags',
        };
    }

    /** Retourne les fonctionnalités sous forme de tableau (une par ligne). */
    public function fonctionnalitesArray(): array
    {
        if (empty($this->fonctionnalites)) {
            return [];
        }
        return array_filter(array_map('trim', explode("\n", $this->fonctionnalites)));
    }
}
