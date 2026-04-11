<?php

namespace App\Http\Controllers;

use App\Models\ActivitySector;
use App\Models\Client;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = Lead::query()->with(['sector', 'owner', 'convertedClient'])->latest();
        $status = trim((string) $request->input('status', ''));
        $search = trim((string) $request->input('q', ''));

        if ($status !== '' && in_array($status, Lead::STATUSES, true)) {
            $query->where('status', $status);
        }

        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder->where('fullname', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhere('phone', 'like', '%'.$search.'%')
                    ->orWhere('company', 'like', '%'.$search.'%');
            });
        }

        $leads = $query->paginate(20)->withQueryString();

        return view('admin.crm.leads.index', [
            'leads' => $leads,
            'statuses' => Lead::STATUSES,
            'filters' => [
                'status' => $status,
                'q' => $search,
            ],
        ]);
    }

    public function create()
    {
        return view('admin.crm.leads.create', $this->formData(new Lead()));
    }

    public function store(Request $request)
    {
        $lead = Lead::query()->create($this->validatedData($request));

        return redirect()
            ->route('admin.leads.edit', $lead)
            ->with('success', 'Lead cree avec succes.');
    }

    public function edit(Lead $lead)
    {
        return view('admin.crm.leads.edit', $this->formData($lead));
    }

    public function update(Request $request, Lead $lead)
    {
        $lead->update($this->validatedData($request));

        return redirect()
            ->route('admin.leads.index')
            ->with('success', 'Lead mis a jour avec succes.');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()
            ->route('admin.leads.index')
            ->with('success', 'Lead supprime avec succes.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'source' => ['nullable', 'string', 'max:50'],
            'fullname' => ['required', 'string', 'max:150'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'company' => ['nullable', 'string', 'max:255'],
            'sector_id' => ['nullable', 'exists:activity_sectors,id'],
            'status' => ['required', Rule::in(Lead::STATUSES)],
            'score' => ['required', 'integer', 'min:0', 'max:100'],
            'notes' => ['nullable', 'string'],
            'owner_id' => ['nullable', 'exists:users,id'],
            'converted_client_id' => ['nullable', 'exists:clients,id'],
            'last_contact_at' => ['nullable', 'date'],
        ]);
    }

    private function formData(Lead $lead): array
    {
        return [
            'lead' => $lead,
            'statuses' => Lead::STATUSES,
            'sectors' => ActivitySector::query()->orderBy('name')->get(),
            'owners' => User::query()->orderBy('name')->get(),
            'clients' => Client::query()->orderBy('name')->get(),
        ];
    }
}
