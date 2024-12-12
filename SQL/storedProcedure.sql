-- findReservations
DELIMITER //

CREATE PROCEDURE findReservations(IN customerId INT)
BEGIN
    SELECT * 
    FROM Reservations
    WHERE customerId = customerId;
END //

DELIMITER ;


-- addSpecialRequest
DELIMITER //

CREATE PROCEDURE addSpecialRequest(IN reservationId INT, IN requests VARCHAR(200))
BEGIN
    UPDATE Reservations
    SET specialRequests = requests
    WHERE reservationId = reservationId;
END //

DELIMITER ;


-- addReservation
DELIMITER //

CREATE PROCEDURE addReservation(
    IN inputCustomerId INT,
    IN reservationTime DATETIME,
    IN numberOfGuests INT,
    IN specialRequests VARCHAR(255)
)
BEGIN
    DECLARE customerId INT;

    -- Check if the customer exists
    SELECT customerId INTO customerId
    FROM Customers
    WHERE customerId = inputCustomerId;

    IF customerId IS NULL THEN
        INSERT INTO Customers (customerName, contactInfo) 
        VALUES ('Default name', 'default.contact@gmail.com'); 

        SET customerId = LAST_INSERT_ID();
    END IF;

    -- Insert the reservation
    INSERT INTO Reservations (customerId, reservationTime, numberOfGuests, specialRequests)
    VALUES (customerId, reservationTime, numberOfGuests, specialRequests); 
END //

DELIMITER ;