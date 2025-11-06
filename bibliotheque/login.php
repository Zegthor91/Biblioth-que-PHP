<?php

session_start();
require_once 'db.php';
include_once 'dashboard.php';

// Vérifie si l'utilisateur est déjà connecté
if (isset($_SESSION['utilisateur_id'])) {
    header('Location: dashboard.php'); // Redirection vers le dashboard si l'utilisateur est bien connecté
    exit;
}

// Vérifie si le formulaire a été envoyé, puis récupération de l'email et password
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Vérifie si les champs ne sont pas vides
    if (empty($email) || empty($password)) {
        $erreur = "Veuillez remplir tous les champs.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreur = "L'adresse email n'est pas valide.";
    } else {
        try {
            $query = "SELECT id, nom, email, password FROM utilisateurs WHERE email = :email";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['email' => $email]);
            $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

            // Stockage des données de l'utilisateur
            if ($utilisateur && password_verify($password, $utilisateur['password'])) {
                $_SESSION['utilisateur_id'] = $utilisateur['id'];
                $_SESSION['utilisateur_nom'] = $utilisateur['nom'];
                $_SESSION['utilisateur_email'] = $utilisateur['email'];
                
                // Redirige l'utilisateur vers le dashboard
                header('Location: dashboard.php');
                exit;
            } else {
                // Si il y a erreur sur l'email ou password
                $erreur = "Email ou mot de passe incorrect.";
            }
            
        } catch(PDOException $e) {
            $erreur = "Erreur lors de la connexion : " . $e->getMessage();
        }
    }
}
?>