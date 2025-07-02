<?php 
    $server = 'localhost';
    $username = 'root';
    $password = '123456';
    $database = 'user_trip_form';

    $conn = mysqli_connect($server ,$username, $password, $database);

    if(!$conn) {
        die("connection failed" . mysqli_connect_error());
    }

    //echo 'success connection';

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //$name = $POST['name'];
        // $age = (int) $_POST['age'];
        $age = filter_var($_POST['age'], FILTER_VALIDATE_INT);
        if ($age === false || $age < 0 || $age > 80) {
            die("Invalid age value");
        }
        // Escape input values to prevent SQL injection - mysqli_real_escape_string
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $other = mysqli_real_escape_string($conn, $_POST['desc']);

        $sql = "INSERT INTO trip (name, age, gender, email, phone, otherinfo)
        VALUES ('$name', $age, '$gender', '$email', '$phone', '$other')";

        //echo $sql;

        if($conn->query($sql) == true) {
            echo "Successfully Inserted";
        } else {
            echo "Error: $sql <br> $conn->error";
        }

  
    }
?>