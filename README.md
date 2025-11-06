# Bibliothèque-PHP Gestion en ligne

## Contexte
Application web pour gérer une bibliothèque locale avec catalogue en ligne et système de favoris pour les utilisateurs.

## Étape 1 : Afficher les livres disponibles

### Consignes :
1. Créez une base de données `bibliotheque` avec une table `livres` contenant les colonnes suivantes : id, titre, auteur.
2. Insérez quelques livres dans la table pour vos tests (par exemple : '1984', 'Le Petit Prince').
3. Créez un fichier `index.php` qui se connecte à la base de données, récupère les livres disponibles, et affiche chaque livre sous forme de liste.
4. Ajoutez des liens pour s'inscrire et se connecter.

## Étape 2 : Créer un système d'inscription

### Consignes :
1. Créez une table `utilisateurs` avec les colonnes suivantes : id, nom, email, password.
2. Créez un fichier `register.php` pour afficher un formulaire HTML et enregistrer un utilisateur dans la base de données après vérification.
3. Hachez le mot de passe avant de l'enregistrer.
4. Redirigez l'utilisateur vers la page de connexion après l'inscription.

## Étape 3 : Système de connexion et tableau de bord

### Consignes :
1. Créez un fichier `login.php` pour afficher un formulaire HTML permettant de vérifier les informations de connexion.
2. Initialisez une session pour l'utilisateur connecté.
3. Créez un fichier `dashboard.php` pour afficher un message de bienvenue et permettre à l'utilisateur de se déconnecter, éditer son compte et voir les livres disponibles.

## Étape 4 : Gestion des favoris

### Consignes :
1. Créez une table `favoris` avec les colonnes suivantes : id, utilisateur_id, livre_id.
2. Modifiez le tableau de bord pour ajouter un bouton 'Ajouter aux favoris' à côté de chaque livre.
3. Ajoutez une section 'Mes favoris' qui affiche uniquement les livres favoris de l'utilisateur connecté.
4. Gérez les interactions utilisateur avec des formulaires HTML.

## Étape 5 : Permettre aux utilisateurs d'ajouter des livres

### Consignes :
1. Modifiez la table livres pour inclure une colonne utilisateur_id afin de suivre qui a ajouté chaque livre.
2. Mise à jour du tableau de bord (dashboard.php) :
   - Ajoutez un formulaire pour permettre à l'utilisateur connecté de saisir :
     - Le titre du livre.
     - L'auteur du livre.
   - Lorsque l'utilisateur soumet le formulaire, le livre est ajouté à la table livres avec l'utilisateur_id du créateur.
3. Validation des données :
   - Vérifiez que le titre et l'auteur ne sont pas vides avant d'ajouter le livre.
   - Affichez un message d'erreur si les champs ne sont pas correctement remplis.
4. Affichage dans le tableau de bord :
   - Après l'ajout, affichez un message de confirmation et mettez à jour la liste des livres pour inclure le nouveau livre.

## Extensions
1. Ajouter une barre de recherche pour filtrer les livres par titre ou auteur (Page d'accueil et dashboard).
2. Ajouter une pagination pour afficher les livres par pages si la liste est longue.

## Structure des fichiers

```
bibliotheque/
├── index.php (Page d'accueil avec les livres disponibles)
├── register.php (Page d'inscription des utilisateurs)
├── login.php (Page de connexion des utilisateurs)
├── dashboard.php (Tableau de bord utilisateur pour gérer les favoris et éditer son compte)
├── classes/
│   ├── Livre.php (Classe pour la gestion des livres)
│   ├── Utilisateur.php (Classe pour la gestion des utilisateurs)
│   ├── Favoris.php (Classe pour la gestion des favoris)
├── db.php (Fichier de connexion à la base de données)
├── logout.php (Fichier pour gérer la déconnexion)
```
