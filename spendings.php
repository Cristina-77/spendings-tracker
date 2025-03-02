<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('connect.php'); 

    $user_id = $_SESSION['user_id'];
    $date = $_POST['date'];
    $item = $_POST['item'];
    $category = $_POST['category'];
    $price = $_POST['price'];

    $query = "INSERT INTO spendings (date, item, category, price) VALUES (?, ?, ?, ?)";
    $stmt = $connect->prepare($query);

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }

    $stmt->bind_param("ssss", $date, $item, $category, $price);

    if ($stmt->execute()) {
        $spendings_id = $stmt->insert_id;

        $query_assoc = "INSERT INTO conectarespendings (user_id, spendings_id) VALUES (?, ?)";
        $stmt_assoc = $connect->prepare($query_assoc);

        if ($stmt_assoc === false) {
            die('Prepare for assoc failed: ' . htmlspecialchars($connect->error));
        }

        $stmt_assoc->bind_param("ii", $user_id, $spendings_id);


        if ($stmt_assoc->execute()) {
            header("location: spendings.html");
        } else {
            die("Error inserting association record: " . htmlspecialchars($stmt_assoc->error));
        }

        $stmt_assoc->close();
    } else {
        die("Error inserting record: " . htmlspecialchars($stmt->error));
    }

    $stmt->close();
    $connect->close();
} 

?>
