<?php
    include('connect.php');
    $fname= $_POST["fname"];
    $lname= $_POST["lname"];
    $email= $_POST["email"];
    $password = $_POST["password"];
    
    if(empty($fname) || empty($lname) || empty($email)|| empty($password)){
        echo "Please complete all the spaces";
    }
    else{
        $stmt = $connect->prepare("SELECT * FROM conectare WHERE `E-mail` = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "There is already an account with this email address.";
        } else {
           
            $query = "INSERT INTO conectare (Fname, Lname, `E-mail`, Password) VALUES ('$fname', '$lname', '$email', '$password')";

                $query_test=mysqli_query($connect, $query);
                if($query_test){
                    echo "Account created with succes";
                    header("location: index.html");
                }
                else{
                    echo "You can't create an account";
                }
            }
            
        
    }
?>