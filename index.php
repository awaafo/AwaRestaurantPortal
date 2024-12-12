<?php
ob_start();
require_once 'restaurantDatabase.php';

class RestaurantPortal {
    private $db;

    public function __construct() {
        $this->db = new RestaurantDatabase();
    }

    public function handleRequest() {
        $action = $_GET['action'] ?? 'home';

        switch ($action) {
            case 'addReservation':
                $this->addReservation();
                break;
            case 'viewReservations':
                $this->viewReservations();
                break;
            case 'deleteReservations':
                $this->deleteReservation();
                break;
            default:
                $this->home();
        }
    }

    private function home() {
        include 'templates/home.php';
    }

    private function addReservation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customerId = $_POST['customer_id'];
            $reservationTime = $_POST['reservation_time'];
            $numberOfGuests = $_POST['number_of_guests'];
            $specialRequests = $_POST['special_requests'];

            $this->db->addReservation($customerId, $reservationTime, $numberOfGuests, $specialRequests);
            header("Location: index.php?action=viewReservations&message=Reservation Added");
        } else {
            include 'templates/addReservation.php';
        }
    }

    private function viewReservations() {
        $search = isset($_POST['submit']) ? $_POST['search'] : '';
        $reservations = $this->db->getAllReservations($search);
        include 'templates/viewReservations.php';
    }
    private function deleteReservation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservationId =  $_POST['reservationId'];
            $this->db->deleteReservation($reservationId);
            header("Location: index.php?action=viewReservations&message=Reservation Deleted");
        }
    }
}

$portal = new RestaurantPortal();
$portal->handleRequest();
