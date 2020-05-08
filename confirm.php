<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php

//Checking if the reset page is getting email and token and if no it will be redirected to index

      if(!isset($_GET['email']) && !isset($_GET['token'])){


        redirect('index');


    }
    //Updating user to activated and setting the row of confirm token to NULL 

if($stmt = mysqli_prepare($connection, 'SELECT username, user_email, confirmtoken FROM users WHERE confirmtoken=?')){


    mysqli_stmt_bind_param($stmt, "s", $_GET['token']);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $username, $user_email, $token);

    mysqli_stmt_fetch($stmt);

    mysqli_stmt_close($stmt);




     if(isset($_GET['email']) && isset($_GET['token'])){


        if($_GET['token'] === $token ){






            if($stmt = mysqli_prepare($connection, "UPDATE users SET confirmtoken='', activated=1 WHERE user_email = ?")){


                mysqli_stmt_bind_param($stmt, "s", $_GET['email']);

                mysqli_stmt_execute($stmt);

                if(mysqli_stmt_affected_rows($stmt) >= 1){

                  redirect('/cms/login.php');


                }

                mysqli_stmt_close($stmt);


            }


        }

    }




}







?>










<?php  include "includes/navigation.php"; ?>

<?php include "includes/footer.php";?>

</div>
