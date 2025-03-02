<?php
session_start();
include('connect.php');

if (!isset($_SESSION['user_id'])) {
    echo 'User not logged in';
    exit;
}

$user_id = $_SESSION['user_id'];

$query = "SELECT category, SUM(price) as total_spent FROM spendings s 
          JOIN conectarespendings cs ON s.ID = cs.spendings_id 
          WHERE cs.user_id = ? GROUP BY category";
$stmt = $connect->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$category_data = array();
while ($row = $result->fetch_assoc()) {
    $category_data[] = $row;
}

echo json_encode($category_data);

$stmt->close();
$connect->close();
?>
