<?php
ob_start();
class RestaurantDatabase {
    private $host = "localhost";
    private $port = "3306";
    private $database = "AwaRestaurant";
    private $user = "root";
    private $password = "root";
    private $connection;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database, $this->port);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
        echo "Successfully connected to the database";
    }

    public function addReservation($customerId, $reservationTime, $numberOfGuests, $specialRequests) {
        //checking if customer id exists
        $count = 0;
        $customerExists = $this->connection->prepare("SELECT COUNT(*) FROM customers WHERE customerId = ?");
        $customerExists->bind_param("i", $customerId);
        $customerExists->execute();
        $customerExists->bind_result($count);
        $customerExists->fetch();
        $customerExists->close();

        if ($count == 0) {
            $customerName = "Default Name"; 
            $contactInfo = "default.contact@gmail.com";
            $customerId = $this->addCustomer($customerName, $contactInfo);
        }

        // Proceeding with adding the reservation
        $stmt = $this->connection->prepare(
            "INSERT INTO reservations (customerId, reservationTime, numberOfGuests, specialRequests) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("isis", $customerId, $reservationTime, $numberOfGuests, $specialRequests);
        $stmt->execute();
        $stmt->close();
        echo "Reservation added successfully";
    }

    public function getAllReservations($search = '') {
        $query = "SELECT * FROM reservations";
        if (!empty($search)) {
            $query .= " WHERE specialRequests LIKE ? OR numberOfGuests LIKE ? OR reservationTime LIKE ? OR customerId LIKE ?";
        }
        $stmt = $this->connection->prepare($query);
        if (!empty($search)) {
            $searchParam = "%" . $search . "%";
            $stmt->bind_param("ssss", $searchParam, $searchParam, $searchParam, $searchParam);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $_POST['submit'] = false;
        $_POST['search'] = '';

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addCustomer($customerName, $contactInfo) {
        $stmt = $this->connection->prepare("INSERT INTO customers (customerName, contactInfo) VALUES (?, ?)");
        $stmt->bind_param("ss", $customerName, $contactInfo);
        $stmt->execute();
        $newCustomerId = $this->connection->insert_id; 
        $stmt->close();
        return $newCustomerId; 
    }

    public function getCustomerPreferences($customerId) {
        $stmt = $this->connection->prepare("SELECT favoriteTable, dietaryRestrictions FROM DiningPreferences WHERE customerId = ?");
        $stmt->bind_param("i", $customerId);
        $stmt->execute();
        $favoriteTable = '';
        $dietaryRestrictions = '';

        $stmt->bind_result($favoriteTable, $dietaryRestrictions);
        $stmt->fetch();
        $stmt->close();
        
        return $favoriteTable || $dietaryRestrictions ? [
            'favoriteTable' => $favoriteTable,
            'dietaryRestrictions' => $dietaryRestrictions
        ] : null;
    }

    public function addSpecialRequest($reservationId, $requests) {
        $stmt = $this->connection->prepare("UPDATE reservations SET specialRequests = ? WHERE reservationId = ?");
        $stmt->bind_param("si", $requests, $reservationId);
        $stmt->execute();
        $stmt->close();
        
        echo "Special request added successfully";
    }

    public function findReservations($customerId) {
        $stmt = $this->connection->prepare("SELECT * FROM reservations WHERE customerId = ?");
        $stmt->bind_param("i", $customerId);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $reservations = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        
        return $reservations;
    }

    public function deleteReservation($reservationId) {
        $stmt = $this->connection->prepare("DELETE FROM reservations WHERE reservationId = ?");
        $stmt->bind_param("i", $reservationId);
        $stmt->execute();
        $stmt->close();
        
        echo "Reservation deleted successfully";
    }

    public function searchPreferences($customerId) {
        return $this->getCustomerPreferences($customerId);
    }
}
?>
