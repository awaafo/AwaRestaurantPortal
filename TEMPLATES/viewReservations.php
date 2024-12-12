<html>
<head><title>View Reservations</title></head>
<body>
    <h1>All Reservations</h1>
    <?= isset($_GET['message']) ? $_GET['message'] : ''?>
    <form method="POST" action="index.php?action=viewReservations">
        <input type="text" name="search" placeholder="Search Reservations" />
        <input type="submit" name="submit" value="Search" />
    </form>

    <table border="1">
        <tr>
            <th>Reservation ID</th>
            <th>Customer ID</th>
            <th>Reservation Time</th>
            <th>Number of Guests</th>
            <th>Special Requests</th>
            <th>Actions</th> 
        </tr>
        <?php foreach ($reservations as $reservation): ?>
        <tr>
            <td><?= htmlspecialchars($reservation['reservationId']) ?></td>
            <td><?= htmlspecialchars($reservation['customerId']) ?></td>
            <td><?= htmlspecialchars($reservation['reservationTime']) ?></td>
            <td><?= htmlspecialchars($reservation['numberOfGuests']) ?></td>
            <td><?= htmlspecialchars($reservation['specialRequests']) ?></td>
            <td>
                <form method="POST" action="index.php?action=deleteReservations"">
                    <input type="hidden" name="reservationId" value="<?= htmlspecialchars($reservation['reservationId']) ?>" />
                    <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this reservation?');" />
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="index.php">Back to Home</a>
</body>
</html>