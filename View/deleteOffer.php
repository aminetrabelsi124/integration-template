<?php
require_once '../Controller/TravelOfferController.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $offerController = new TravelOfferController();
    $offerController->deleteOffer($id);
} else {
    echo "ID invalide!";
}
?>