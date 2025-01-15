<!DOCTYPE html>
<html>
<head>
    <title>Formulaire de commande</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <!-- Formulaire de commande -->
    <form action="traitement_commande.php" method="post">
        <!-- Champ pour le nom du client -->
        <label for="nom">Nom du client :</label>
        <input type="text" id="nom" name="nom" required><br>

        <!-- Champ pour le produit -->
        <label for="produit">Produit :</label>
        <input type="text" id="produit" name="produit" required><br>

        <!-- Menu déroulant pour la catégorie du produit -->
        <label for="categorie">Catégorie :</label>
        <select id="categorie" name="categorie" required>
            <option value="Vins non alcoolisés">Vins non alcoolisés</option>
            <option value="Produits pour bébés">Produits pour bébés</option>
            <option value="Jouets">Jouets</option>
            <option value="Voitures électriques neuves">Voitures électriques neuves</option>
            <option value="Autres">Autres</option>
        </select><br>

        <!-- Champ pour la quantité -->
        <label for="quantite">Quantité :</label>
        <input type="number" id="quantite" name="quantite" min="1" required><br>

        <!-- Champ pour la date de livraison -->
        <label for="date">Date de livraison :</label>
        <input type="date" id="date" name="date" required><br>

        <!-- Bouton pour valider la commande -->
        <button type="submit">Valider la commande</button>
    </form>
</body>
</html>