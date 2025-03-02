<?php
require_once '../Controller/TravelOfferController.php';
$offerController = new TravelOfferController();
$offers = $offerController->listOffre();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Offres</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        a {
            text-decoration: none;
            padding: 5px 10px;
            margin: 5px;
            color: white;
            border-radius: 5px;
        }
        .btn-delete { background-color: red; }
        .btn-update { background-color: orange; }
        .btn-add { background-color: green; }
    </style>
</head>
<body>
<h1>Liste des Offres de Voyages</h1>
<div style="margin-bottom: 10px;">
    <a href="addOffre.php" class="btn-add">Ajouter une offre</a>
</div>
<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Destination</th>
        <th>Departure Date</th>
        <th>Return Date</th>
        <th>Price</th>
        <th>Disponibilité</th>
        <th>Catégorie</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($offers as $offer): ?>
        <tr>
            <td><?= htmlspecialchars($offer['id']); ?></td>
            <td><?= htmlspecialchars($offer['title']); ?></td>
            <td><?= htmlspecialchars($offer['destination']); ?></td>
            <td><?= htmlspecialchars($offer['departure_date']); ?></td>
            <td><?= htmlspecialchars($offer['return_date']); ?></td>
            <td><?= htmlspecialchars($offer['price']); ?></td>
            <td><?= $offer['disponible'] ? 'Oui' : 'Non'; ?></td>
            <td><?= htmlspecialchars($offer['category']); ?></td>
            <td>
                <a href="updateOffer.php?id=<?= $offer['id']; ?>" class="btn-update">Modifier</a>
                <a href="deleteOffer.php?id=<?= $offer['id']; ?>" class="btn-delete" onclick="return confirm('Confirmer la suppression ?');">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>