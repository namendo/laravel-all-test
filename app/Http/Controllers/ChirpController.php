<?php

namespace App\Http\Controllers;

use App\Events\ChirpCreated;
use App\Models\Chirp;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View 
    {
        //   query builder
        
        $user = $request->user();
        $chirps = Chirp::with('user')->latest()->get();

        return view('chirps.index', ['chirps' => $chirps ]);
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
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $current = Chirp::create([
            'message' => $validated['message'],
            'user_id' => $request->user()->id,
        ]);

        //ChirpCreated::dispatch($current);
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
        Gate::authorize('update', $chirp);
 
        return view('chirps.edit', [
            'chirp' => $chirp,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp): RedirectResponse
    {
        Gate::authorize('update', $chirp);
 
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $chirp->update($validated);

        // return $user->id === $post->user_id
        //         ? Response::allow()
        //         : Response::deny('You do not own this post.');
 
        return redirect(route('chirps.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp): RedirectResponse
    {
        Gate::authorize('delete', $chirp);
 
        $chirp->delete();
 
        return redirect(route('chirps.index')); //
    }
}
