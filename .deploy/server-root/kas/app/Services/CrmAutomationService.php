<?php

namespace App\Services;

use App\Models\ContactMessage;
use App\Models\CrmActivity;
use App\Models\Lead;

class CrmAutomationService
{
    public function captureContactLead(ContactMessage $message): Lead
    {
        $lead = Lead::query()->firstOrNew(['email' => $message->email]);

        $lead->fullname = $message->fullname;
        $lead->phone = $message->phone;
        $lead->source = $lead->source ?: 'WEBSITE_CONTACT';
        $lead->status = in_array($lead->status, Lead::STATUSES, true) ? $lead->status : 'NEW';
        $lead->score = min(100, (int) ($lead->score ?? 0) + 10);
        $lead->notes = trim(($lead->notes ? $lead->notes."\n\n" : '').'Contact website: '.$message->message);
        $lead->last_contact_at = now();
        $lead->save();

        CrmActivity::query()->create([
            'lead_id' => $lead->id,
            'type' => 'EMAIL',
            'subject' => 'Nouveau message website',
            'description' => $message->message,
            'status' => 'DONE',
            'completed_at' => now(),
        ]);

        return $lead;
    }
}
