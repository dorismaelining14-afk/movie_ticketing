<?php
include 'db.php';

$movieTitle = $_GET['movie'];

$stmt = $conn->prepare("
    SELECT b.seat_number 
    FROM bookings b
    JOIN movies m ON b.movie_id = m.id
    WHERE m.title = ?
");

$stmt->bind_param("s", $movieTitle);
$stmt->execute();

$result = $stmt->get_result();

$seats = [];

while($row = $result->fetch_assoc()){
    $seats[] = $row['seat_number'];
}

echo json_encode($seats);
?>