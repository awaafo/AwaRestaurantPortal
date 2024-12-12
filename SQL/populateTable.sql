-- Customers
INSERT INTO Customers (customerName, contactInfo)
VALUES
    ('John Doe', 'john.doe@example.com'),
    ('Jane Smith', 'jane.smith@example.com'),
    ('Michael Johnson', 'michael.johnson@example.com');

-- Reservations
INSERT INTO Reservations (customerId, reservationTime, numberOfGuests, specialRequests)
VALUES
    (1, '2024-12-15 18:30:00', 4, 'Near the window'),
    (2, '2024-12-16 19:00:00', 2, 'Vegan options, please'),
    (3, '2024-12-17 20:00:00', 6, 'Celebrating a birthday');

-- DiningPreferences

INSERT INTO DiningPreferences (customerId, favoriteTable, dietaryRestrictions)
VALUES
    (1, 'Table 5', 'Gluten-free'),
    (2, 'Table 3', 'Vegetarian'),
    (3, 'Table 1', 'No restrictions');
