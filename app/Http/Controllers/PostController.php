<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            // recuperation de tous les posts par ordre decroissant
            $posts = Post::orderBy('last_update', 'desc')
            ->get();
            return response()->json([
                'message' => 'Liste de tous les posts',
                'post' => $posts,
            ], 201);
        }catch (\Exception $e) {
            // Retourner une réponse JSON avec un message d'erreur en cas d'exception..
            return response()->json([
                'message' => "Oups une erreur est survenue lors de cette opération, veuillez réessayer svp.",
                'error' => $e->getMessage(),
            ], 500);
        }

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
    public function store(Request $request)
    {
        try {
            // Vérifier si un fichier image a été envoyé
            if ($request->hasFile('image_url')) {
                // Déplacer le fichier vers le dossier de stockage
                $imagePath = $request->file('image_url')->store('post_images', 'public');
                // Vérifier si le fichier a été correctement déplacé
                if ($imagePath) {
                    // Ajouter le chemin de l'image à la requête
                    $request->merge(['image_path' => $imagePath]);
                } else {
                    // Gérer l'erreur si le fichier n'a pas pu être déplacé
                    throw new \Exception("Erreur lors du déplacement de l'image.");
                }
            }
            // Création su slud à partir du title
            $slug = Str::slug($request->title);
            $request->merge(['slug' => $slug]);
            
            // Créer un nouveau post
            $post = Post::create($request->all());
            if ($post) {
                // Retourner une réponse JSON avec un message de succès et les données du post..
                return response()->json([
                    'message' => 'Post enregistré avec succès',
                    'post' => $post,
                ], 201);
            }else{
                // Retourner une réponse JSON avec un message d'erreur en cas d'exception..
                return response()->json([
                    'message' => "Oups une erreur est survenue lors de cette opération, veuillez réessayer svp.",
                ], 500);
            }
        }catch (\Exception $e) {
            // Retourner une réponse JSON avec un message d'erreur en cas d'exception..
            return response()->json([
                'message' => "Oups une erreur est survenue lors de cette opération, veuillez réessayer svp.",
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            // recuperation du post par id
            $post = Post::findOrFail($id);
            return response()->json([
                'message' => 'Recherche du post par id',
                'post' => $post,
            ], 201);
        }catch (\Exception $e) {
            // Retourner une réponse JSON avec un message d'erreur en cas d'exception..
            return response()->json([
                'message' => "Oups une erreur est survenue lors de cette opération, veuillez réessayer svp.",
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show_slug(string $slug)
    {
        //
        try{
            // recuperation du post par slug
            $post = Post::where('slug', $slug)->first();
            return response()->json([
                'message' => 'Recherche du post par slug',
                'post' => $post,
            ], 201);
        }catch (\Exception $e) {
            // Retourner une réponse JSON avec un message d'erreur en cas d'exception..
            return response()->json([
                'message' => "Oups une erreur est survenue lors de cette opération, veuillez réessayer svp.",
                'error' => $e->getMessage(),
            ], 500);
        }
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
