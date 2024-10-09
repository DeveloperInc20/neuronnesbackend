## Neuronnes Technologies documentation

**ETAPE 1: Création des migrations: users, posts**

**ETAPE 2: Installation du package JWT:**
CAS DU PACKAGE (tymon/jwt-auth)
$composer require tymon/jwt-auth

- Ajouter Dans le header de la requette:
Accept: "application/json", et Authorization: "Bearer  token_authentification.."

JWT pour authentification des utilisateurs par token (Gestion de la sécurité des routes) pour accéder aux ressources.

**ETAPE 3:**
- Création de routes API AUTH : login, register, logout (POST METHOD)
- Création de routes API POST: 

a- Création de post, 
b-liste des posts, 
c- detail d’un post du user connecté
c- detail d’un post du user connecté (à partir du slug)
d- mise à jour d’un post du user connecté
e- supprimer d’un post qui appartient au user connecté

**ETAPE 4:**
- création de la methode creation du profil

**ETAPE 5:**
- création d'un post
- liste des posts du user connecté 
- récuperation du post par ID du user connecté 
- récuperation du post par SLUG du user connecté 
- mise à jour d’un post du user connecté