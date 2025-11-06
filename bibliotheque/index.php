<?php

require_once 'db.php';
include_once 'dashboard.php';
include_once 'register.php';
include_once 'login.php';

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Bibliothèque en ligne locale</h1>
    <link href="dashboard.php">

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