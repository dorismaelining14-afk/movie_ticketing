<?php
include 'db.php';

// Fetch bookings with JOIN
$sql = "
SELECT 
    b.id,
    c.name AS customer_name,
    m.title AS movie_title,
    m.genre,
    m.show_time,
    b.seat_number
FROM bookings b
JOIN customers c ON b.customer_id = c.id
JOIN movies m ON b.movie_id = m.id
ORDER BY b.id DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>
<style>
body {
    font-family: Arial;
    background: #111;
    color: white;
    padding: 20px;
}

h1 {
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    color: black;
}

th, td {
    padding: 10px;
    border: 1px solid #ccc;
    text-align: center;
}

th {
    background: #e50914;
    color: white;
}

tr:hover {
    background: #f2f2f2;
}

.delete-btn {
    background: red;
    color: white;
    padding: 5px 10px;
    border: none;
    cursor: pointer;
}

</style>
</head>

<body>

<h1>🎬 ADMIN PANEL - BOOKINGS</h1>

<table>
<tr>
    <th>ID</th>
    <th>Customer</th>
    <th>Movie</th>
    <th>Genre</th>
    <th>Time</th>
    <th>Seat</th>
    <th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()){ ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['customer_name']; ?></td>
    <td><?php echo $row['movie_title']; ?></td>
    <td><?php echo $row['genre']; ?></td>
    <td><?php echo $row['show_time']; ?></td>
    <td><?php echo $row['seat_number']; ?></td>
    <td>
        <form method="POST" action="delete.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button class="delete-btn">Delete</button>
        </form>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>