<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model {
    protected $fillable = ['sector_id','name','logo_url','logo_path','website_url','description'];

    public function sector() { return $this->belongsTo(ActivitySector::class, 'sector_id'); }
    public function projects() { return $this->hasMany(Project::class, 'client_id'); }
}
