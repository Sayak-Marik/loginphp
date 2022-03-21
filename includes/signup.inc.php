<?php
    if(isset($_POST['signup-submit'])){
        require 'dbh.inc.php';

        $username = $_POST['uid'];
        $email = $_POST['mail'];
        $password = $_POST['pwd'];
        $passwordconfirm = $_POST['pwd-repeat'];

        if(empty($username)||empty($email)||empty($password)||empty($passwordconfirm)){
            header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail".$email); 
            exit();
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header("Location: ../signup.php?error=emptyfields&uid=".$username); 
            exit();
        }
        elseif(!preg_match("/^[a-zA-Z0-9]*$/" , $username)){
            header("Location: ../signup.php?error=emptyfields&mail=".$email); 
            exit();
        }
        elseif($password !== $passwordconfirm){
            header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail".$email);  
            exit();
        }
        else{
            $sql="SELECT  user_uid from users where  user_uid=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../sign.php?error=sqlerror");
                exit();
        }
        else{
            mysqli_stmt_bind_param($stmt,"s",$username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultcheck = mysqli_stmt_num_rows($stmt);
            if($resultcheck>0){
                header("Location: ../sign.php?error=sqlerror");
                exit();
            }
        else{
            $sql = "INSERT INTO users(user_email, user_uid ,user_pwd) VALUES (?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../sign.php?error=sqlerror");
                exit();
            }
            else{

                mysqli_stmt_bind_param($stmt,"sss",$email,$username,$password);
                mysqli_stmt_execute($stmt);

                header("Location: ../signup.php?signup=success");
                exit();
            }
        }
    }
}
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    else{
        header("Location: ../signup.php");
        exit();
    }
?>