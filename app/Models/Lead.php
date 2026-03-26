<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    public const STATUSES = ['NEW', 'QUALIFIED', 'NURTURING', 'LOST', 'CONVERTED'];

    protected $fillable = [
        'source',
        'fullname',
        'email',
        'phone',
        'company',
        'sector_id',
        'status',
        'score',
        'notes',
        'owner_id',
        'converted_client_id',
        'last_contact_at',
    ];

    protected $casts = [
        'last_contact_at' => 'datetime',
    ];

    public function sector() { return $this->belongsTo(ActivitySector::class, 'sector_id'); }
    public function owner() { return $this->belongsTo(User::class, 'owner_id'); }
    public function convertedClient() { return $this->belongsTo(Client::class, 'converted_client_id'); }
    public function opportunities() { return $this->hasMany(Opportunity::class, 'lead_id'); }
    public function activities() { return $this->hasMany(CrmActivity::class, 'lead_id'); }
}
