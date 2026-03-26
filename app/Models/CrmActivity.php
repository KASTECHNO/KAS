<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrmActivity extends Model
{
    public const TYPES = ['CALL', 'EMAIL', 'MEETING', 'TASK', 'NOTE'];
    public const STATUSES = ['PENDING', 'DONE', 'CANCELED'];

    protected $fillable = [
        'lead_id',
        'client_id',
        'opportunity_id',
        'type',
        'subject',
        'description',
        'due_at',
        'completed_at',
        'status',
        'owner_id',
    ];

    protected $casts = [
        'due_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function lead() { return $this->belongsTo(Lead::class, 'lead_id'); }
    public function client() { return $this->belongsTo(Client::class, 'client_id'); }
    public function opportunity() { return $this->belongsTo(Opportunity::class, 'opportunity_id'); }
    public function owner() { return $this->belongsTo(User::class, 'owner_id'); }
}
