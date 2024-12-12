--Create Customers Table
CREATE TABLE Customers (
    customerId INT NOT NULL AUTO_INCREMENT,
    customerName VARCHAR(45) NOT NULL,
    contactInfo VARCHAR(200),
    PRIMARY KEY (customerId),
    UNIQUE (customerId)
);

-- Create Reservations Table
CREATE TABLE Reservations (
    reservationId INT NOT NULL AUTO_INCREMENT,
    customerId INT NOT NULL,
    reservationTime DATETIME NOT NULL,
    numberOfGuests INT NOT NULL,
    specialRequests VARCHAR(200),
    PRIMARY KEY (reservationId),
    UNIQUE (reservationId),
    FOREIGN KEY (customerId) REFERENCES Customers(customerId) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create DiningPreferences Table
CREATE TABLE DiningPreferences (
    preferenceId INT NOT NULL AUTO_INCREMENT,
    customerId INT NOT NULL,
    favoriteTable VARCHAR(45),
    dietaryRestrictions VARCHAR(200),
    PRIMARY KEY (preferenceId),
    UNIQUE (preferenceId),
    FOREIGN KEY (customerId) REFERENCES Customers(customerId) ON DELETE CASCADE ON UPDATE CASCADE
);
