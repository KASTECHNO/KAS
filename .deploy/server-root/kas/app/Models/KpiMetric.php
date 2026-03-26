<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KpiMetric extends Model
{
    protected $fillable = [
        'key',
        'title',
        'value',
        'unit',
        'description',
        'formula_rule',
        'data_snapshot',
        'is_active',
        'display_order',
        'last_calculated_at',
    ];

    protected $casts = [
        'data_snapshot' => 'array',
        'is_active' => 'boolean',
        'last_calculated_at' => 'datetime',
    ];
}
