<?php

session_start();
require_once 'db.php';

// Vérifie la connexion de l'utilisateur
if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['utilisateur_id'];
$message = '';
$error = '';

// Ajout d’un livre
if (!empty($_POST['add_livre'])) {
    $titre = trim($_POST['titre'] ?? '');
    $auteur = trim($_POST['auteur'] ?? '');
    if ($titre && $auteur) {
        $stmt = $pdo->prepare("INSERT INTO livres (titre, auteur, utilisateur_id) VALUES (?, ?, ?)");
        $stmt->execute([$titre, $auteur, $user_id]);
        $message = "Livre ajouté !";
    } else {
        $error = "Titre et auteur requis.";
    }
}

// Ajout aux favoris
if (!empty($_POST['favori'])) {
    $livre_id = (int)$_POST['favori'];
    $stmt = $pdo->prepare("SELECT 1 FROM favoris WHERE utilisateur_id=? AND livre_id=?");
    $stmt->execute([$user_id, $livre_id]);
    if (!$stmt->fetch()) {
        $stmt = $pdo->prepare("INSERT INTO favoris (utilisateur_id, livre_id) VALUES (?, ?)");
        $stmt->execute([$user_id, $livre_id]);
        $message = "Ajouté aux favoris.";
    }
}

// Récupère la liste des livres
$livres = $pdo->query("SELECT id, titre, auteur FROM livres ORDER BY titre")->fetchAll(PDO::FETCH_ASSOC);

// Récupère les favoris de l'utilisateur
$mes_favoris = $pdo->prepare("
    SELECT l.titre, l.auteur FROM livres l INNER JOIN favoris f ON l.id = f.livre_id WHERE f.utilisateur_id = ?
");
$mes_favoris->execute([$user_id]);
$mes_favoris = $mes_favoris->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
</head>
<body>
    <h1>Bienvenue</h1>
    <div class="navigation">
        <a href="register.php">Register</a>
        <a href="login.php">Log In</a>
        <a href="logout.php">Log out</a>
    </div>
    
</body>
</html>