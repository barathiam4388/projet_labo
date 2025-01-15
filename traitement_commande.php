<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $produit = $_POST['produit'];
    $categorie = $_POST['categorie'];
    $quantite = $_POST['quantite'];
    $date = $_POST['date'];

    // Validation des données
    if (empty($nom) || empty($produit) || empty($categorie) || empty($quantite) || empty($date)) {
        echo "Tous les champs sont obligatoires.";
        exit;
    }

    if ($quantite <= 0) {
        echo "La quantité doit être un nombre positif.";
        exit;
    }

    if (strtotime($date) < strtotime(date("Y-m-d"))) {
        echo "La date de livraison doit être future.";
        exit;
    }

    // Calculs
    $prix_unitaire = 20; // Exemple de prix unitaire
    $sous_total = $quantite * $prix_unitaire;
    $taxe_federale = $sous_total * 0.05;
    $taxe_provinciale = 0;

    // Calcul de la taxe provinciale si la catégorie n'est pas exemptée
    if (!in_array($categorie, ["Vins non alcoolisés", "Produits pour bébés", "Jouets", "Voitures électriques neuves"])) {
        $taxe_provinciale = $sous_total * 0.0995;
    }

    $total_ttc = $sous_total + $taxe_federale + $taxe_provinciale;

    // Affichage du résumé de la commande
    echo "<div class='summary'>";
    echo "<h2>Résumé de la commande</h2>";
    echo "<p>Nom du client : $nom</p>";
    echo "<p>Produit : $produit</p>";
    echo "<p>Catégorie : $categorie</p>";
    echo "<p>Quantité : $quantite</p>";
    echo "<p>Sous-total : " . number_format($sous_total, 2) . " $</p>";
    echo "<p>Taxe fédérale (5%) : " . number_format($taxe_federale, 2) . " $</p>";
    echo "<p>Taxe provinciale (9.95%) : " . ($taxe_provinciale > 0 ? number_format($taxe_provinciale, 2) . " $" : "Exemptée") . "</p>";
    echo "<p>Total TTC : " . number_format($total_ttc, 2) . " $</p>";
    echo "<p>Date de livraison : $date</p>";

    // Avertissement si la date de livraison est dans le passé
    if (strtotime($date) < strtotime(date("Y-m-d"))) {
        echo "<p class='warning'>Attention : La date de livraison est dans le passé.</p>";
    }
    echo "</div>";
}
?>