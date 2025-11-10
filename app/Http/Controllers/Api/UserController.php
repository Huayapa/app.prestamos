<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function getUsers() {
        $users = User::all();
        return response()->json([
            'data' => $users
        ]);
    }

    public function getUser(string $id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado.',
            ], 404);
        }

        return response()->json([
            'message' => 'Usuario recuperado exitosamente.',
            'data' => $user,
        ]);
    }

    public function create(Request $request) {
        $validatedata = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        $user = User::create([
            'name' => $validatedata['name'],
            'email' => $validatedata['email'],
            'password' => Hash::make($validatedata['password']),
        ]);

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'data' => $user
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado.'], 404);
        }
        
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|string|min:8',
        ]);

        $user->fill($validatedData);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        return response()->json([
            'message' => 'Usuario actualizado exitosamente.',
            'data' => $user,
        ]);
    }
    public function destroy(string $id)
    {
        $user = User::find($id);
        if (auth()->user()->id === $id) {
            return response()->json([
                'message' => 'No puedes eliminar tu propia cuenta a través de esta ruta.',
            ], 403);
        }

        $user->delete();

        return response()->json([
            'message' => 'Usuario eliminado exitosamente.',
        ], 200); 
    }
}
