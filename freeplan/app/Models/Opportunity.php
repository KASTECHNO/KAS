<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    public const STAGES = ['DISCOVERY', 'QUALIFICATION', 'PROPOSAL', 'NEGOTIATION', 'WON', 'LOST'];
    public const STATUSES = ['OPEN', 'WON', 'LOST'];

    protected $fillable = [
        'lead_id',
        'client_id',
        'name',
        'amount',
        'currency',
        'stage',
        'probability',
        'expected_close_date',
        'status',
        'owner_id',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'expected_close_date' => 'date',
    ];

    public function lead() { return $this->belongsTo(Lead::class, 'lead_id'); }
    public function client() { return $this->belongsTo(Client::class, 'client_id'); }
    public function owner() { return $this->belongsTo(User::class, 'owner_id'); }
    public function activities() { return $this->hasMany(CrmActivity::class, 'opportunity_id'); }
}
