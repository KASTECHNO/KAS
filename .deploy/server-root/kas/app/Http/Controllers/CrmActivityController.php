<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\CrmActivity;
use App\Models\Lead;
use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CrmActivityController extends Controller
{
    public function index(Request $request)
    {
        $query = CrmActivity::query()->with(['lead', 'client', 'opportunity', 'owner'])->latest();
        $type = trim((string) $request->input('type', ''));
        $status = trim((string) $request->input('status', ''));
        $search = trim((string) $request->input('q', ''));

        if ($type !== '' && in_array($type, CrmActivity::TYPES, true)) {
            $query->where('type', $type);
        }

        if ($status !== '' && in_array($status, CrmActivity::STATUSES, true)) {
            $query->where('status', $status);
        }

        if ($search !== '') {
            $query->where('subject', 'like', '%'.$search.'%');
        }

        $activities = $query->paginate(20)->withQueryString();

        return view('admin.crm.activities.index', [
            'activities' => $activities,
            'types' => CrmActivity::TYPES,
            'statuses' => CrmActivity::STATUSES,
            'filters' => [
                'type' => $type,
                'status' => $status,
                'q' => $search,
            ],
        ]);
    }

    public function create()
    {
        return view('admin.crm.activities.create', $this->formData(new CrmActivity()));
    }

    public function store(Request $request)
    {
        $activity = CrmActivity::query()->create($this->validatedData($request));

        return redirect()
            ->route('admin.crm-activities.edit', $activity)
            ->with('success', 'Activite CRM creee avec succes.');
    }

    public function edit(CrmActivity $crm_activity)
    {
        return view('admin.crm.activities.edit', $this->formData($crm_activity));
    }

    public function update(Request $request, CrmActivity $crm_activity)
    {
        $crm_activity->update($this->validatedData($request));

        return redirect()
            ->route('admin.crm-activities.index')
            ->with('success', 'Activite CRM mise a jour avec succes.');
    }

    public function destroy(CrmActivity $crm_activity)
    {
        $crm_activity->delete();

        return redirect()
            ->route('admin.crm-activities.index')
            ->with('success', 'Activite CRM supprimee avec succes.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'lead_id' => ['nullable', 'exists:leads,id'],
            'client_id' => ['nullable', 'exists:clients,id'],
            'opportunity_id' => ['nullable', 'exists:opportunities,id'],
            'type' => ['required', Rule::in(CrmActivity::TYPES)],
            'subject' => ['required', 'string', 'max:180'],
            'description' => ['nullable', 'string'],
            'due_at' => ['nullable', 'date'],
            'completed_at' => ['nullable', 'date'],
            'status' => ['required', Rule::in(CrmActivity::STATUSES)],
            'owner_id' => ['nullable', 'exists:users,id'],
        ]);
    }

    private function formData(CrmActivity $activity): array
    {
        return [
            'activity' => $activity,
            'types' => CrmActivity::TYPES,
            'statuses' => CrmActivity::STATUSES,
            'leads' => Lead::query()->orderBy('fullname')->get(),
            'clients' => Client::query()->orderBy('name')->get(),
            'opportunities' => Opportunity::query()->orderBy('name')->get(),
            'owners' => User::query()->orderBy('name')->get(),
        ];
    }
}
