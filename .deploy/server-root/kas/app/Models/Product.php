<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
   protected $fillable = [
    'sector_id',
    'name',
    'slug',
    'short_desc',
    'description',
    'image_url',
    'image_path',
    'price',
    'display_order',
    'is_active'
];

    public function sector() { return $this->belongsTo(ActivitySector::class, 'sector_id'); }
}
