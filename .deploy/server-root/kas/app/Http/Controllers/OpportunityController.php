<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Lead;
use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OpportunityController extends Controller
{
    public function index(Request $request)
    {
        $query = Opportunity::query()->with(['lead', 'client', 'owner'])->latest();
        $stage = trim((string) $request->input('stage', ''));
        $status = trim((string) $request->input('status', ''));
        $search = trim((string) $request->input('q', ''));

        if ($stage !== '' && in_array($stage, Opportunity::STAGES, true)) {
            $query->where('stage', $stage);
        }

        if ($status !== '' && in_array($status, Opportunity::STATUSES, true)) {
            $query->where('status', $status);
        }

        if ($search !== '') {
            $query->where('name', 'like', '%'.$search.'%');
        }

        $kanbanColumns = collect(Opportunity::STAGES)->map(function ($currentStage) use ($query) {
            $items = (clone $query)
                ->where('stage', $currentStage)
                ->orderBy('expected_close_date')
                ->get();

            return [
                'stage' => $currentStage,
                'items' => $items,
                'count' => $items->count(),
                'amount' => (float) $items->sum('amount'),
            ];
        });

        $opportunities = $query->paginate(20)->withQueryString();

        return view('admin.crm.opportunities.index', [
            'opportunities' => $opportunities,
            'kanbanColumns' => $kanbanColumns,
            'stages' => Opportunity::STAGES,
            'statuses' => Opportunity::STATUSES,
            'filters' => [
                'stage' => $stage,
                'status' => $status,
                'q' => $search,
            ],
        ]);
    }

    public function create()
    {
        return view('admin.crm.opportunities.create', $this->formData(new Opportunity()));
    }

    public function store(Request $request)
    {
        $opportunity = Opportunity::query()->create($this->validatedData($request));

        return redirect()
            ->route('admin.opportunities.edit', $opportunity)
            ->with('success', 'Opportunite creee avec succes.');
    }

    public function edit(Opportunity $opportunity)
    {
        return view('admin.crm.opportunities.edit', $this->formData($opportunity));
    }

    public function update(Request $request, Opportunity $opportunity)
    {
        $opportunity->update($this->validatedData($request));

        return redirect()
            ->route('admin.opportunities.index')
            ->with('success', 'Opportunite mise a jour avec succes.');
    }

    public function updateStage(Request $request, Opportunity $opportunity)
    {
        $payload = $request->validate([
            'stage' => ['required', Rule::in(Opportunity::STAGES)],
        ]);

        $status = 'OPEN';
        if ($payload['stage'] === 'WON') {
            $status = 'WON';
        }
        if ($payload['stage'] === 'LOST') {
            $status = 'LOST';
        }

        $opportunity->update([
            'stage' => $payload['stage'],
            'status' => $status,
        ]);

        return redirect()
            ->route('admin.opportunities.index')
            ->with('success', 'Etape de l opportunite mise a jour avec succes.');
    }

    public function destroy(Opportunity $opportunity)
    {
        $opportunity->delete();

        return redirect()
            ->route('admin.opportunities.index')
            ->with('success', 'Opportunite supprimee avec succes.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'lead_id' => ['nullable', 'exists:leads,id'],
            'client_id' => ['nullable', 'exists:clients,id'],
            'name' => ['required', 'string', 'max:180'],
            'amount' => ['required', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'size:3'],
            'stage' => ['required', Rule::in(Opportunity::STAGES)],
            'probability' => ['required', 'integer', 'min:0', 'max:100'],
            'expected_close_date' => ['nullable', 'date'],
            'status' => ['required', Rule::in(Opportunity::STATUSES)],
            'owner_id' => ['nullable', 'exists:users,id'],
            'notes' => ['nullable', 'string'],
        ]);
    }

    private function formData(Opportunity $opportunity): array
    {
        return [
            'opportunity' => $opportunity,
            'stages' => Opportunity::STAGES,
            'statuses' => Opportunity::STATUSES,
            'leads' => Lead::query()->orderBy('fullname')->get(),
            'clients' => Client::query()->orderBy('name')->get(),
            'owners' => User::query()->orderBy('name')->get(),
        ];
    }
}
