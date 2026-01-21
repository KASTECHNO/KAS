<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    // FRONT : store
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'email'    => 'required|email',
            'message'  => 'required',
        ]);

        ContactMessage::create($request->all());

        return back()->with('success', 'Message sent successfully.');
    }

    // ADMIN : index
    public function index()
    {
        $messages = ContactMessage::latest()->get();
        return view('admin.contact_messages.index', compact('messages'));
    }

    // ADMIN : show
    public function show(ContactMessage $contact_message)
    {
        return view('admin.contact_messages.show', compact('contact_message'));
    }

    // ADMIN : destroy
    public function destroy(ContactMessage $contact_message)
    {
        $contact_message->delete();

        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'Message deleted successfully.');
    }
}
