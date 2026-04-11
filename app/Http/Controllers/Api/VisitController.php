<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            'status' => 'success',
            'visits' => Visit::paginate(25),
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['exists:users,id', 'sometimes'],
            'client_id' => ['exists:clients,id', 'required'],
            'motif_id' => ['exists:clients,id', 'required'],
        ]);

        $visit = Visit::create($validated);

        return [
            'status' => 'success',
            'message' => 'Visite créée avec succès',
            'visit' => $visit,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $visit = Visit::find($id);

        if (! $visit) {
            return response()->json([
                'status' => 'error',
                'message' => 'Visite non trouvée',
            ], 404);
        }

        return [
            'status' => 'success',
            'visit' => $visit,
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $client)
    {

        $validated = $request->validate([
            'client_id' => ['exists:clients,id', 'required'],
            'motif_id' => ['exists:clients,id', 'required'],
        ]);

        $visit = Visit::find($client);

        if (! $visit) {
            return response()->json([
                'status' => 'error',
                'message' => 'Visite non trouvée',
            ], 404);
        }

        $visit->motif_id = $validated['motif_id'] ?? $visit->motif_id;
        $visit->client_id = $validated['client_id'] ?? $visit->client_id;
        $visit->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Visite mise à jour avec succès',
            'visit' => $visit,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $client)
    {
        $visit = Visit::find($client);

        if (! $visit) {
            return response()->json([
                'status' => 'error',
                'message' => 'Visite non trouvée',
            ], 404);
        }

        $visit->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Visite supprimée avec succès',
        ]);
    }
}
