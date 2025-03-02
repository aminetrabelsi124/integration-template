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
    $departure_date = $_POST['departure_date'];
    $return_date = $_POST['return_date'];

    $offerController->updateOfferDates($id, $departure_date, $return_date);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier les Dates de l'Offre</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        form {
            max-width: 400px;
            margin: auto;
            background: #ffffff;
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
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 15px;
            font-size: 16px;
            padding: 10px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h1 style="text-align: center;">Modifier les Dates</h1>

<form method="POST">
    <label>Date de départ:</label>
    <input type="date" name="departure_date" value="<?= $offer->getDepartureDate(); ?>" required>

    <label>Date de retour:</label>
    <input type="date" name="return_date" value="<?= $offer->getReturnDate(); ?>" required>

    <button type="submit">Modifier</button>
</form>

</body>
</html>