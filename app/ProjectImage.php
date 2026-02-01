<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class ProjectImage extends Model {
    protected $fillable = ['project_id','image_url','caption','display_order'];
    public function project() { return $this->belongsTo(Project::class); }
}
