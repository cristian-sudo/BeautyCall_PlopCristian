<?php

require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/header.php');
        $stmt = $dbh->getInstance()->prepare("UPDATE bookings
          SET BookingStatus= 'Confirmed'
          WHERE BookingID=:bolean");

        $stmt->bindParam(':bolean', $bolean);

        foreach ($_POST as $index => $value) {
                $bolean = $index;
                $stmt->execute();
        }
        header('Location: ManageBookings.php');
        exit;
?>
