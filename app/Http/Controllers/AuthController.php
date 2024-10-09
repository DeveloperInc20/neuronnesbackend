<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function register(Request $request)
    {
        try {
            // Vérifier si un fichier image a été envoyé
            if ($request->hasFile('picture_file')) {
                // Déplacer le fichier vers le dossier de stockage
                $picturePath = $request->file('picture_file')->store('profile_pictures', 'public');
                // Ajouter le chemin de l'image à la requête
                $request->merge(['picture_path' => $picturePath]);
            }
            // Créer un nouvel utilisateur
            $user = User::create($request->all());
            if ($user) {
                // Retourner une réponse JSON avec un message de succès et les données de l'utilisateur..
                return response()->json([
                    'message' => 'Utilisateur enregistré avec succès',
                    'user' => $user,
                ], 201);
            }else{
                // Retourner une réponse JSON avec un message d'erreur et les données de l'utilisateur..
                return response()->json([
                    'message' => "Erreur lors de l'enregistrement de l'utilisateur",
                    'user' => $user,
                ], 500);
            }
        } catch (\Exception $e) {
            // Retourner une réponse JSON avec un message d'erreur en cas d'exception..
            return response()->json([
                'message' => "Oups une erreur est survenue lors de cette opération, veuillez réessayer svp.",
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
