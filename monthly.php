<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('connect.php');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
$current_year = date('Y');

$sql = "SELECT DATE_FORMAT(s.date, '%Y-%m') AS month, SUM(s.price) AS total_spent 
FROM spendings s
JOIN conectarespendings cs ON s.ID = cs.spendings_id 
WHERE cs.user_id = ? AND YEAR(s.date) = ? 
GROUP BY month";

if ($stmt = $connect->prepare($sql)) {
    $stmt->bind_param("ii", $user_id, $current_year);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = array();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Query preparation failed: ' . $connect->error]);
}

$connect->close();
?>
