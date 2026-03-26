<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'sector_id','client_id','title','slug','short_desc','description',
        'start_date','end_date','main_image_url','main_image_path','is_featured'
    ];

    public function sector() { return $this->belongsTo(ActivitySector::class, 'sector_id'); }
    public function client() { return $this->belongsTo(Client::class, 'client_id'); }
    public function images() { return $this->hasMany(ProjectImage::class); }
}
