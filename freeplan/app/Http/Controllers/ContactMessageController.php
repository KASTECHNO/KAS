<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Services\CrmAutomationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactMessageController extends Controller
{
    public function store(Request $request, CrmAutomationService $crmAutomationService)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $contactMessage = ContactMessage::create($validated);

        try {
            $crmAutomationService->captureContactLead($contactMessage);
        } catch (\Throwable $exception) {
            Log::warning('Unable to capture CRM lead from contact form.', [
                'contact_message_id' => $contactMessage->id,
                'error' => $exception->getMessage(),
            ]);
        }

        return redirect()->back()->with('success', 'Message envoye avec succes !');
    }

    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);

        return view('admin.contact_messages.index', compact('messages'));
    }

    public function show(ContactMessage $contact_message)
    {
        return view('admin.contact_messages.show', ['message' => $contact_message]);
    }

    public function destroy(ContactMessage $contact_message)
    {
        $contact_message->delete();

        return redirect()
            ->route('admin.contact-messages.index')
            ->with('success', 'Message supprime avec succes.');
    }

    public function delete(ContactMessage $contact_message)
    {
        return $this->destroy($contact_message);
    }
}
