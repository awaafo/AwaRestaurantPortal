# AwaRestaurantPortal
AwaRestaurantPortal is a web-based platform developed using PHP and MySQL to help restaurant managers streamline reservation scheduling and enhance dining experiences. This system enables managers to efficiently handle reservations, track customer preferences, and maintain a seamless database for customer and reservation management.



AwaRestaurantPortal

Overview

AwaRestaurantPortal is a web-based platform designed to streamline restaurant management by providing tools for managing reservations, tracking customer preferences, and enhancing the dining experience. This project was developed using PHP and MySQL as part of a final project for CIS coursework.

Features

Customer Management:

Automatically check if a customer exists in the database before creating a reservation.

Add new customers directly or during the reservation process.

Reservation Management:

Add, modify, or cancel reservations.

Track reservations by customer with integrated dining preferences.

Dining Preferences:

Store and retrieve customer-specific preferences, including favorite tables and dietary restrictions.

Database Design

The project uses a MySQL database named restaurant_reservations with the following tables:

Customers Table

customerId (Primary Key, INT, Auto Increment)

customerName (VARCHAR)

contactInfo (VARCHAR, email or phone)

Reservations Table

reservationId (Primary Key, INT, Auto Increment)

customerId (Foreign Key, links to Customers table)

reservationTime (DATETIME)

numberOfGuests (INT)

specialRequests (VARCHAR)

DiningPreferences Table

preferenceId (Primary Key, INT, Auto Increment)

customerId (Foreign Key, links to Customers table)

favoriteTable (VARCHAR)

dietaryRestrictions (VARCHAR)

Key Functionalities

Stored Procedures and Functions

findReservations(customerId): Retrieves all reservations for a specific customer.

addSpecialRequest(reservationId, requests): Updates special requests for a reservation.

addReservation(customerName, reservationTime, numberOfGuests, specialRequests): Checks or creates a customer and then adds a reservation.

PHP Implementation

Database Connection: Updated in RestaurantDatabase.php to match MySQL server details.

Core Methods:

addCustomer($customerName, $contactInfo)

addReservation($customerName, $reservationTime, $numberOfGuests, $specialRequests)

getCustomerPreferences($customerId)

viewReservations()

Bonus Features

Additional methods:

addSpecialRequest($reservationId, $requests)

findReservations($customerId)

deleteReservation($reservationId)

searchPreferences($customerId)

Setup and Deployment

Prerequisites

PHP: Install a local PHP server (e.g., XAMPP, WAMP, or LAMP).

MySQL: Ensure MySQL is installed and running.

Starter Code: Clone or download the starter files from the provided GitHub link.

Steps to Run the Project

Clone this repository:

git clone https://github.com/awaafo/AwaRestaurantPortal.git

Set up the database:

Create a database named restaurant_reservations.

Run the provided SQL scripts to create tables and populate data.

Update database connection details in RestaurantDatabase.php.

Start the PHP server and test the application locally.

Access the application through your local server (e.g., http://localhost/AwaRestaurantPortal).

Deliverables

Source Code: PHP files and SQL scripts.

Report: Detailed explanation of code, database structure, and platform features.

GitHub Repository: Public repository link with all project files and documentation.

Live Presentation: Showcase project functionality via Zoom.

