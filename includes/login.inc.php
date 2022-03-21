<?php
    if(isset($_POST['login-submit'])){
        require 'dbh.inc.php';
        $mailuid = $_POST['mailuid'];
        $password = $_POST['pwd'];
        if(empty($mailuid)||empty($password)){
            header("Location: ../index.php?error=emptyfields");
            exit();
        }
        else{
            if(!$conn){
                header("Location: ../index.php?error=sqlerror");
                exit();
            }
           else{
                $sql = "SELECT * from users where user_uid='$mailuid' or user_email='$mailuid'";
                $result =mysqli_query($conn, $sql);              
                if(mysqli_num_rows($result) > 0){                   
                    $row = mysqli_fetch_assoc($result);
                    if($password !== $row['user_pwd']){
                        header("Location: ../index.php?error=wrongpass");
                        exit();
                    }
                    elseif($password == $row['user_pwd']){
                        session_start();
                        $_SESSION['userid']=$row['user_id'];
                        $_SESSION['useruid']=$row['user_uid'];
                        header("Location: ../index.php?login=success");
                        exit();
                    }
                    else{
                        header("Location: ../index.php?error=wrongpass");
                        exit();
                    }
                }
            }
        }
        }
     else{
         header("Location: ../signup.php");
         exit();
     }