<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::with('user')
            ->latest()
            ->get();

        return view('admin.contact.index', compact('messages'));
    }
    public function show(ContactMessage $message)
    {
        return response()->json([
            'id'         => $message->id,
            'subject'    => $message->subject,
            'message'    => $message->message,
            'created_at' => $message->created_at->format('d M Y H:i'),
            'user'       => [
                'name'  => $message->user?->name ?? 'Anonim',
                'email' => $message->user?->email ?? '-',
            ],
        ]);
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return back()->with('success', 'Pesan berhasil dihapus.');
    }
}
