<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit()
    {
        // Trova l'utente corrente
        $user = Auth::user();

        // Mostra la vista di modifica con l'utente corrente
        return view('users/edit', ['user' => $user]);
    }

    public function update(Request $request)
    {
        // Trova l'utente corrente
        $user = Auth::user();

        // Valida i dati di input
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'region_id' => 'nullable',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // valida l'immagine se presente
        ]);

        // Check if a profile image has been uploaded
        if ($request->has('image')) {
            // Store image
            $validatedData['image'] = $request->file('image')->store('public/Media-Css');
        }

        // Aggiorna l'utente con i dati validati
        $user->update($validatedData);

        // Reindirizza l'utente alla pagina che preferisci
        return redirect()->route('homepage')->with('status', 'Profile updated successfully');
    }
}
