<?php
session_start();

include('connect.php');

$email = $_POST['email'];
$password = $_POST['password'];

if(empty($email) || empty($password)){
    echo "Please complete your data";
}
else{
    $query = "SELECT * FROM conectare WHERE `E-mail`=? AND Password=?";
    $stmt = mysqli_prepare($connect, $query);

    mysqli_stmt_bind_param($stmt, "ss", $email, $password);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    
    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['ID'];
        header("location: home.html");
    }
    else{
        echo "Email or password incorrect";
    }
}
?>