<?php
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/Salon/Menu.php');
?>
<?php


$stmt10 = $dbh->getInstance()->prepare("SELECT DISTINCT users.UserID,Name,Surname FROM users
INNER JOIN bookings ON bookings.UserID=users.UserID
WHERE bookings.ServiceProviderID =:ServiceProviderID ORDER BY Surname ASC");

    $stmt10->bindParam(':ServiceProviderID', $ServiceProviderID);
    $ServiceProviderID = $_SESSION['ServiceProviderID'];
    $stmt10->execute();
    while ($row = $stmt10->fetch()) {
$NOB=0;
            $stmt12 = $dbh->getInstance()->prepare('SELECT count(*) AS NOB FROM bookings
            WHERE UserID="'.$row['UserID'].'" AND ServiceProviderID="'.$_SESSION['ServiceProviderID'].'"  ');
            $stmt12->execute();
            while ($row1 = $stmt12->fetch()) {
                $NOB=$row1['NOB'];
            }


echo '

<div class="card-footer text-muted">

    Name:&nbsp '.$row['Name'].'  &nbsp  '.$row['Surname'].'    <br>
    Total number of bookings:'.$NOB.'

</div>';



    }



?>
                   





</body>
</html>