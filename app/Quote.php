<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = [
        'fullname',
        'email',
        'phone',
        'message',
        'service_id',
        'project_id',
        'status'
    ];

    // Relation vers Service
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // Relation vers Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

