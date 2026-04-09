<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class AppControllerApi extends Controller
{
    public function addRole(Request $request) {

        $validated = $request->validate([
            'libelle' => ['required', 'string', 'unique:roles,libelle']
        ]);

        $role = Role::create($validated);

        return [
            'message' => 'Role créé avec succès',
            'role' => $role
        ];
    }
}
