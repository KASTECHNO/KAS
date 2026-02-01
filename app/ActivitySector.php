<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivitySector extends Model {
    protected $fillable = ['name','description','icon_class','display_order','is_active'];
    public function clients() { return $this->hasMany(Client::class, 'sector_id'); }
    public function products() { return $this->hasMany(Product::class, 'sector_id'); }
    public function projects() { return $this->hasMany(Project::class, 'sector_id'); }
}
