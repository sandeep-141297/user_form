<?php
    if(isset($_POST['name'])) {
        $server = 'localhost';
        $username = 'root';
        $password = '123456';
        $database = 'user_trip_form';

        $conn = new mysqli($server ,$username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            //die("Connection failed: " . $conn->connect_error);
            $msg = "Connection failed: " . $conn->connect_error;
        }

        $age = filter_var($_POST['age'], FILTER_VALIDATE_INT);
        if ($age === false || $age < 0 || $age > 80) {
            $msg = "Invalid age value";
        }
        // Escape input values to prevent SQL injection - mysqli_real_escape_string
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $other = mysqli_real_escape_string($conn, $_POST['desc']);

        $sql = "INSERT INTO trip (name, age, gender, email, phone, otherinfo)
        VALUES ('$name', $age, '$gender', '$email', '$phone', '$other')";

        if($conn->query($sql) == true) {
            //echo "Successfully Inserted";
            $msg = 'Successfully Inserted';
        } else {
            //echo "Error: $sql <br> $conn->error";
            $msg = "Error: $sql <br> $conn->error";
        }

        $conn->close();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel form</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>
            Welcome to Travel Form
        </h1>
        <p>Enter your details and submit your form</p>
        <?php
            echo isset($msg) ? "<p class='resMsg'>$msg</p>" : "";
        ?>

        <form action="index.php" method="post">
            <input type="text" name="name" id="name" placeholder="Enter your name">
            <input type="text" name="age" id="age" placeholder="Enter your age">
            <input type="text" name="gender" id="gender" placeholder="Enter your gender">
            <input type="email" name="email" id="email" placeholder="Enter your email">
            <input type="phone" name="phone" id="phone" placeholder="Enter your phone">
            <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Enter more information"></textarea>
            <button class="btn"> Submit </button>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>