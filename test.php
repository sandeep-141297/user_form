<?php
$conn = mysqli_connect("localhost", "root", "123456", "", '3307');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Show which user and host you're connected as
$result = mysqli_query($conn, "SELECT @@hostname AS host, @@port AS port, CURRENT_USER() AS user");
$row = mysqli_fetch_assoc($result);
echo "Connected as user: " . $row['user'] . "<br>";
echo "Host: " . $row['host'] . "<br>";
echo "Port: " . $row['port'] . "<br>";

// Show all databases this user can see
$result = mysqli_query($conn, "SHOW DATABASES");
echo "<h3>Available Databases:</h3><ul>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<li>" . $row['Database'] . "</li>";
}
echo "</ul>";

mysqli_close($conn);
?>
