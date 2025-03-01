<?php
require_once '../Controller/TravelOfferController.php';

$offerController = new TravelOfferController();
$offer = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $offer = $offerController->getOfferById($id);
}

if (!$offer) {
    echo "<p style='color: red; text-align: center;'>Offre introuvable.</p>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updatedOffer = [
        'id' => $id,
        'title' => $_POST['title'],
        'destination' => $_POST['destination'],
        'departure_date' => $_POST['departure_date'],
        'return_date' => $_POST['return_date'],
        'price' => $_POST['price'],
        'disponible' => isset($_POST['disponible']) ? 1 : 0,
        'category' => $_POST['category']
    ];
    
    $offerController->updateOffer($id, $updatedOffer);
    header("Location: listOffers.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une Offre</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 500px;
            margin: auto;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        input, button {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h1 style="text-align: center;">Modifier l'Offre</h1>

<form method="POST">
    <label>Title:</label>
    <input type="text" name="title" value="<?= htmlspecialchars($offer['title'] ?? ''); ?>" required>

    <label>Destination:</label>
    <input type="text" name="destination" value="<?= htmlspecialchars($offer['destination'] ?? ''); ?>" required>

    <label>Date de départ:</label>
    <input type="date" name="departure_date" value="<?= $offer['departure_date'] ?? ''; ?>" required>

    <label>Date de retour:</label>
    <input type="date" name="return_date" value="<?= $offer['return_date'] ?? ''; ?>" required>

    <label>Prix:</label>
    <input type="number" name="price" step="0.01" value="<?= $offer['price'] ?? ''; ?>" required>

    <label>Disponible:</label>
    <input type="checkbox" name="disponible" <?= isset($offer['disponible']) && $offer['disponible'] ? 'checked' : ''; ?>>

    <label>Catégorie:</label>
    <input type="text" name="category" value="<?= htmlspecialchars($offer['category'] ?? ''); ?>" required>

    <button type="submit">Modifier</button>
</form>

</body>
</html>
