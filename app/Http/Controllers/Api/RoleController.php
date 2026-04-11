<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([Role::paginate(25)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => ['required', 'in_array:manager,responsable']
        ]);

        $role = Role::create($validated);

        return response()->json([
            'status' => 'success',
            'role' => $role
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $role)
    {
        $role = Role::findOrFail($role);

        return response()->json(['status' => 'success', 'role' => $role]);
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
