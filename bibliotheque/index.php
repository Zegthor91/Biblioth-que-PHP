<?php

session_start();
require_once 'db.php';

// Traitement de la recherche
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque en ligne locale</title>
    
</head>
<body>
    <div class="navigation">
        <?php if (isset($_SESSION['utilisateur_id'])): ?>
            <span>Bonjour, <?= htmlspecialchars($_SESSION['utilisateur_nom']) ?></span>
            <a href="dashboard.php">Tableau de bord</a>
            <a href="logout.php">Se déconnecter</a>
        <?php else: ?>
            <a href="register.php">S'inscrire</a>
            <a href="login.php">Se connecter</a>
        <?php endif; ?>
    </div>

    <h1>Bibliothèque en ligne locale</h1>

    <!-- Barre de recherche -->
    <div class="search-bar">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Search ..." value="<?= htmlspecialchars($search) ?>">
            <button type="submit">Rechercher</button>
            <?php if ($search): ?>
                <a href="index.php">Supprimer</a>
            <?php endif; ?>
        </form>
    </div>

<h2>Livres disponibles</h2>

<?php

try {
    $query = "SELECT id, titre, auteur FROM livres ORDER BY titre"; // Info du livre via une requete SQL
    $stmt = $pdo->query($query); // Exécutution de la requête SQL
    $livres = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récuperation de tous les livres

    if (count($livres) > 0) {
        // Boucle foreach pour parcourir et afficher chaque livre avec id, user_id, titre et auteur
        foreach ($livres as $livre) {
            echo 'div class="livre-id">';
            echo '<div class="livre-utilisateur_id">';'</div>';
            echo '<div class="livre-titre">' . htmlspecialchars($livre['titre']) . '</div>';
            echo '<div class="livre-auteur">par ' . htmlspecialchars($livre['auteur']) . '</div>';
            echo '</div>';
        }
    } else {
        echo "<p>Aucun livre disponible pour l'instant</p>"; // Affichage si aucun livre est dsponible
    }
} catch(PDOException $e) {
    echo '<p>Erreur : ' . $e->getMessage() . '</p>';
}

?>

<h2>Mes favoris</h2>
<?php

// Vérifie et parcours si il y a des éléments dans le tableau
if (!empty($mes_favoris)) {
    foreach ($mes_favoris as $favori) {
     
        ?>
        <div>
            <?= htmlspecialchars($favori['titre']); ?> 
            ,                        <!-- Affichage des livres, du titre et de l'auteur -->                    
            <?= htmlspecialchars($favori['auteur']); ?>
        </div>
        <?php
    }
} else {
    // Dans le cas où la liste des favoris est vide
    ?>
    <div>Pas de favori</div>
    <?php
}
?>
</div>

</body>
</html>