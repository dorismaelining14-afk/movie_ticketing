<?php
include 'db.php';

$name = $_POST['name'];
$movieTitle = $_POST['movie'];
$seats = $_POST['seats'];

// get movie_id
$stmt = $conn->prepare("SELECT id FROM movies WHERE title=?");
$stmt->bind_param("s", $movieTitle);
$stmt->execute();
$result = $stmt->get_result();
$movie = $result->fetch_assoc();
$movie_id = $movie['id'];

// insert customer
$stmt = $conn->prepare("INSERT INTO customers (name) VALUES (?)");
$stmt->bind_param("s", $name);
$stmt->execute();
$customer_id = $conn->insert_id;

// insert seats
$stmt = $conn->prepare("INSERT INTO bookings (customer_id, movie_id, seat_number) VALUES (?,?,?)");

foreach($seats as $seat){
    $stmt->bind_param("iis", $customer_id, $movie_id, $seat);
    $stmt->execute();
}

echo "Success";
?>