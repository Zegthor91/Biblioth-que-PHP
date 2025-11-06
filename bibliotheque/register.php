<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Inscription</h1>

        <!-- Formulaire d'inscription -->
        <form method="POST" action="">
            <div>
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="<?php echo isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : ''; ?>" required>
            </div>
            <div>
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
            </div>
            <div>
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
                <span>6 caractères minimum</span>
            </div>
            <div>
                <label for="password_confirm">Confirmer :</label>
                <input type="password" id="password_confirm" name="password_confirm" required>
            </div>
            <button type="submit">Register</button>
        </form>

        <div>
            <link href="dashboard.php">
        </div>
    </div>
</body>
</html>

<?php

session_start(); 
require_once 'db.php'; 

// Traitement du formulaire d'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']); // Nettoie le nom
    $email = trim($_POST['email']); // Nettoie l'email
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // Vérifie les différents champs
    if (empty($nom) || empty($email) || empty($password) || empty($password_confirm)) {
        $erreur = "Tous les champs sont obligatoires.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreur = "L'adresse email n'est pas valide.";
    } elseif (strlen($password) < 6) {
        $erreur = "Le mot de passe doit contenir au moins 6 caractères.";
    } elseif ($password !== $password_confirm) {
        $erreur = "Les mots de passe ne correspondent pas.";
    } else {
        // Vérifie si l'email est déjà existant
        $stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            $erreur = "Cette adresse email est déjà utilisée.";
        } else {
            // Hache le mot de passe
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            // Ajoute l'utilisateur en BDD
            $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, email, password) VALUES (:nom, :email, :password)");
            $stmt->execute([
                'nom' => $nom,
                'email' => $email,
                'password' => $password_hash
            ]);
            // Message de succès et redirection
            $succes = "Inscription réussie ! Redirection...";
            header("refresh:2;url=login.php");
        }
    }

}

?>