<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('created_at', 'desc')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        Faq::create($data);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil ditambahkan');
    }

    public function edit(Faq $faq)
    {
        return response()->json($faq);
    }
    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'question' => 'required|string',
            'answer'   => 'required|string',
        ]);

        $faq->update($data);

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ berhasil diperbarui');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil dihapus');
    }
}
