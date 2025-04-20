<?php
        include '../includes/connection.php';

        if(isset($_POST['sign-in'])){
            $email = $_POST['email'];
            $pass = md5($_POST['pass']);

            if($email !="" || $pass !=""){
                $sql = "SELECT * FROM staff WHERE email ='$email'";
                $result = $conn->query($sql);
                $row = mysqli_fetch_assoc($result);

                if($row['pass'] === $pass){
                    session_start();
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['name'] = $row['first_name'];
                    $_SESSION['role'] = $row['roles'];
                    $_SESSION['address'] = $row['address'];
                    header("Location: ../dashboard.php");
                } else {
                    echo "password hashes not match";
                }
            } else {
                echo "enter inputs";
            }
        }
    ?>