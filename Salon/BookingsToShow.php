<?php
if($_GET['OrderBy']=="Default"){
$stmt5 = $dbh->getInstance()->prepare("SELECT *,users.Name AS UserName,users.Surname AS UserSurname, staff.Name AS StaffName FROM bookings
INNER JOIN users ON bookings.UserID=users.UserID
INNER JOIN services ON bookings.ServiceID=services.ServiceID
INNER JOIN staffs ON bookings.StaffID=staffs.StaffID
INNER JOIN servicecategories ON services.ServiceCategoryID=servicecategories.ServiceCategoryID
WHERE bookings.ServiceProviderID =:ServiceProviderID
ORDER BY bookings.BookingID DESC
");

    $stmt5->bindParam(':ServiceProviderID', $ServiceProviderID);
    $ServiceProviderID = $_SESSION['ServiceProviderID'];
    $stmt5->execute();
}

?>