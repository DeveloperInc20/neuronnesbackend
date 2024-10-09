<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

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

    public function logout(){
        dd("logout user ...");
    }

    public function login(Request $request){
        try {
            // Valider les données de la requête
            $request->validate([
                "email" => "required|email",
                "password" => "required|min:4"
            ],[
                'email.required' => 'L\'email est obligatoire.',
                'email.email' => 'L\'adresse email doit être valide.',
                'password.required' => 'Le mot de passe est obligatoire.',
                'password.min' => 'Le mot de passe doit contenir au moins 4 caractères.',
            ]);
            //
            // Authentification avec JWT
        $token = JWTAuth::attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);

        // en cas de succès
        if(!empty($token)){
            return response()->json([
                "status" => true,
                "message" => "Utilisateur authentifié avec succès.",
                "token" => $token,
            ]);
        }
        // en cas d'échec
        return response()->json([
            "status" => false,
            "message" => "Connexion échouée, informations invalides"
        ],401);

        } catch (\Exception $e) {
            // en cas d'erreur server
            return response()->json([
                'message' => "Oups une erreur est survenue lors de cette opération, veuillez réessayer svp.",
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        try {
            // Vérifier si un fichier image a été envoyé
            if ($request->hasFile('image_url')) {
                // Déplacer le fichier vers le dossier de stockage
                $picturePath = $request->file('image_url')->store('profile_pictures', 'public');
                // Ajouter le chemin de l'image à la requête
                $request->merge(['picture_path' => $picturePath]);
            }
            // Créer un nouvel utilisateur           
            $user = User::create($request->all());
            if ($user) {
                //$token = JWTAuth::fromUser($user);
                $token = JWTAuth::attempt([
                    "email" => $request->email,
                    "password" => $request->password
                ]);
                // Retourner une réponse JSON avec un message de succès et les données de l'utilisateur..
                return response()->json([
                    'message' => 'Utilisateur enregistré avec succès',
                    'user' => $user,
                    'token' => $token,
                ], 201);
            }else{
                // Retourner une réponse JSON avec un message d'erreur et les données de l'utilisateur..
                return response()->json([
                    'message' => "Erreur lors de l'enregistrement de l'utilisateur",
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
