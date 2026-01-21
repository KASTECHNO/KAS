<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = ['sector_id','name','slug','description','price','image_url','is_active'];
    public function sector() { return $this->belongsTo(ActivitySector::class, 'sector_id'); }
}
