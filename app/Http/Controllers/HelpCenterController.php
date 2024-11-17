<?php

namespace App\Http\Controllers;

use App\Models\HelpCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelpCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $helpCenters = HelpCenter::where('user_id', Auth::id())->get();
        // return view('helpcenter.index', compact('helpCenters'));
        // Ambil semua bantuan yang sudah dibuat oleh user saat ini
        $helpCenters = HelpCenter::where('user_id', Auth::id())->get();

        // Return ke view 'helpcenter.index' dengan data bantuan yang ditemukan
        return view('helpcenter.index', compact('helpCenters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('helpcenter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:500',
            'description' => 'required|string',
        ]);

        HelpCenter::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        return to_route('helpcenter.index')->with('success', 'Pertanyaan berhasil diajukan');
    }

    /**
     * Display the specified resource.
     */
    public function show(HelpCenter $helpCenter)
    {
        if ($helpCenter->user_id !== Auth::id()) {
            abort(403);
        }
        return view('helpcenter.show', compact('helpCenter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
