<?php
require_once '../Controller/TravelOfferController.php';
require_once '../Model/TravelOffer.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $offer = new TravelOffer(
        $_POST['title'],
        $_POST['destination'],
        $_POST['departure_date'],
        $_POST['return_date'],
        $_POST['price'],
        $_POST['disponible'],
        $_POST['category']
    );
    $offerController = new TravelOfferController();
    $offerController->addOffre($offer);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une Offre</title>
</head>
<body>
<h1>Ajouter une Nouvelle Offre</h1>
<form method="POST">
    <label>Title:</label> <input type="text" name="title" required><br>
    <label>Destination:</label> <input type="text" name="destination" required><br>
    <label>Date de départ:</label> <input type="date" name="departure_date" required><br>
    <label>Date de retour:</label> <input type="date" name="return_date" required><br>
    <label>Prix:</label> <input type="number" name="price" step="0.01" required><br>
    <label for="disponible">Disponible :</label>
    <select name="disponible" required>
        <option value="1">Oui</option>
        <option value="0">Non</option>
    </select>
    <label>Catégorie:</label> <input type="text" name="category" required><br>
    <button type="submit">Ajouter</button>
</form>
</body>
</html>