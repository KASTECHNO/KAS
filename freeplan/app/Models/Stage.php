<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Stage extends Model
{
    protected $fillable = [
        'titre',
        'slug',
        'domaine',
        'type_stage',
        'niveau_requis',
        'description',
        'technologies',
        'date_limite',
        'is_active',
    ];

    protected $casts = [
        'date_limite' => 'date',
        'is_active'   => 'boolean',
    ];

    public function candidatures()
    {
        return $this->hasMany(StageCandidature::class);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($stage) {
            if (empty($stage->slug)) {
                $stage->slug = Str::slug($stage->titre);
            }
        });
    }
}
