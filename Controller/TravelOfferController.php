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
        $sql = "INSERT INTO offers (title, destination, departure_date, return_date, price, disponible, category) 
                VALUES (:title, :destination, :departure_date, :return_date, :price, :disponible, :category)";
        try {
            $query = $this->db->prepare($sql);
            $id = $offer->getId();
            $title = $offer->getTitle();
            $destination = $offer->getDestination();
            $departure_date = $offer->getDepartureDate();
            $return_date = $offer->getReturnDate();
            $price = $offer->getPrice();
            $disponible = $offer->isDisponible() ? 1 : 0;
            $category = $offer->getCategory();
    
            $query->execute([
                'title' => $title,
                'destination' => $destination,
                'departure_date' => $departure_date,
                'return_date' => $return_date,
                'price' => $price,
                'disponible' => $disponible,
                'category' => $category
            ]);
    
            header("Location: listOffers.php");
            exit();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    public function updateOfferDates($id, $departure_date, $return_date) {
        $sql = "UPDATE offers SET departure_date = :departure_date, return_date = :return_date WHERE id = :id";
        try {
            $query = $this->db->prepare($sql);
            $query->execute([
                'id' => $id,
                'departure_date' => $departure_date,
                'return_date' => $return_date
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