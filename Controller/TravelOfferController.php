<?php
require_once '../Config.php';
require_once '../Model/TravelOffer.php';
class TravelOfferController {
    private $db;
    public function __construct() {
        $this->db=config::getConnexion();
    }
    public function listOffre() {
        $sql = "SELECT * FROM offers";
        try {
            $query = $this->db->query($sql);
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    public function deleteOffer($id) {
        $sql = "DELETE FROM offers WHERE id = :id";
        try {
            $query = $this->db->prepare($sql);
            $query->execute(['id' => $id]);
            header("Location: listOffers.php");
            exit();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    public function addOffre($offer) {
        require_once '../Model/TravelOffer.php';
        require_once '../Config.php';
    
        $db = Config::getConnexion();
        if (is_array($offer)) {
            $offer = new TravelOffer(
                $offer['title'],
                $offer['destination'],
                $offer['departure_date'],
                $offer['return_date'],
                $offer['price'],
                $offer['disponible'],
                $offer['category']
            );
        }
        $query = "INSERT INTO offers (title, destination, departure_date, return_date, price, disponible, category) 
        VALUES (:title, :destination, :departure_date, :return_date, :price, :disponible, :category)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':title', $offer->getTitle());
        $stmt->bindParam(':destination', $offer->getDestination());
        $stmt->bindParam(':departure_date', $offer->getDepartureDate());
        $stmt->bindParam(':return_date', $offer->getReturnDate());
        $stmt->bindParam(':price', $offer->getPrice());
        $stmt->bindParam(':disponible', $offer->isDisponible());
        $stmt->bindParam(':category', $offer->getCategory());
        if ($stmt->execute()) {
            header("Location: ../View/listOffers.php");
            exit();
        } else {
            echo "Erreur lors de l'ajout de l'offre.";
        }
    }
    public function updateOffer($id, $offer) {
        $sql = "UPDATE offers SET title = :title, destination = :destination, departure_date = :departure_date, 
                return_date = :return_date, price = :price, disponible = :disponible, category = :category WHERE id = :id";
        try {
            $query = $this->db->prepare($sql);
            $query->execute([
                'id' => $offer->getId(),
                'title' => $offer->getTitle(),
                'destination' => $offer->getDestination(),
                'departure_date' => $offer->getDepartureDate(),
                'return_date' => $offer->getReturnDate(),
                'price' => $offer->getPrice(),
                'disponible' => $offer->isDisponible(),
                'category' => $offer->getCategory()
            ]);
            header("Location: listOffers.php");
            exit();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    public function getOfferById($id) {
        $db = Config::getConnexion();
        $query = $db->prepare("SELECT * FROM offers WHERE id = :id");
        $query->execute(['id' => $id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            return new TravelOffer(
                $result['id'],
                $result['title'],
                $result['destination'],
                $result['departure_date'],
                $result['return_date'],
                $result['price'],
                $result['disponible'],
                $result['category']
            );
        }
        return null;
    }
}