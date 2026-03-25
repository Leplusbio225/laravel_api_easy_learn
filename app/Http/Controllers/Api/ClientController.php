<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            'status' => 'success',
            'clients' => Client::paginate(25),
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => ['required', 'in:M,F'],
            // 'email' => 'required|email|unique:clients',
            'contact' => 'required|string|max:20',
            // 'address' => 'nullable|string',
        ]);

        $client = Client::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Le client créé avec succès',
            'client' => $client,
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(int $client)
    {
        $client = Client::find($client);

        if(! $client) {
            return response()->json([
                'status' => 'error',
                'message' => 'Client non trouvé',
            ], 404);
        }

        return [
            'status' => "success",
            'client' => $client,
        ];

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $client)
    {
        $client = Client::findOrFail($client);

        $client->update($request->only(['name', 'contact', 'gender']));
        // $client->update($request->only(['name', 'email', 'telephone', 'address']));

        return [
            'status' => 'success',
            'message' => 'Client mis à jour avec succès',
            'client' => $client,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $client)
    {
        $client = Client::findOrFail($client);
        $client->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Client supprimé avec succès',
        ]);
    }
}
