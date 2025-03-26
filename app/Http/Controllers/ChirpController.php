<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        return view('chirps.index', [
            'chirps' => Chirp::with('user')->latest()->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        /*$validated = $request->validate([*/
        /*    'message' => 'string|max:250',*/
        /*    'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048', // 2MB max*/
        /*]);*/

        $validator = Validator::make($request->all(), [
            'message' => 'nullable|string|max:250',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        $validator->after(function ($validator) use ($request) {
            if (empty($request->message) && !$request->hasFile('image')) {
                $validator->errors()->add('message', 'We can’t read your mind. Yet.');
            }
        });


        $validated = $validator->validate();

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('chirp-images', 'public');
            $validated['image'] = $path;
        }

        $request->user()->chirps()->create($validated);

        return redirect(route('chirps.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp): View
    {
        //
        Gate::authorize('update', $chirp);
        return view('chirps.edit', [
            'chirp' => $chirp
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp): RedirectResponse
    {
        //
        Gate::authorize('update', $chirp);

        $validated = $request->validate([
            'message' => 'required|string|max:255'
        ]);

        $chirp->update($validated);

        return redirect(route('chirps.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp): RedirectResponse
    {
        //
        Gate::authorize('delete', $chirp);

        if ($chirp->image && Storage::disk('public')->exists($chirp->image)) {
            Storage::disk('public')->delete($chirp->image);
        }

        $chirp->delete();
        return redirect(route('chirps.index'));
    }
}
