<?php use PHPMailer\PHPMailer\PHPMailer; ?>

<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

<?php

require './vendor/autoload.php';
require './classes/config.php';

          if($_SERVER['REQUEST_METHOD'] == "POST") {

              $first_name = trim($_POST['first_name']);
              $last_name = trim($_POST['last_name']);
              $username = trim($_POST['username']);
              $email    = trim($_POST['email']);
              $password = trim($_POST['password']);


              $error = [

                  'username'=> '',
                  'email'=>'',
                  'password'=>'',
                  'first_name'=>'',
                  'last_name'=>''

              ];


              if(strlen($username) < 4){

                  $error['username'] = 'Username needs to be longer than 4';


              }
              if(strlen($username) > 10){

                  $error['username'] = 'Username needs to be shorter than 12 ';


              }

               if($username ==''){

                  $error['username'] = 'Username cannot be empty';


              }


               if(username_exists($username)){

                  $error['username'] = 'Username already exists, pick another another';


              }




              if($first_name ==''){

                  $error['first_name'] = 'Firstname cannot be empty';


              }
              if($last_name ==''){

                  $error['last_name'] = 'Last namecannot be empty';


              }


               if(email_exists($email)){

                  $error['email'] = 'Email already exists, <a href="index.php">Please login</a>';


              }


              if($password == '') {


                  $error['password'] = 'Password cannot be empty';

              }

              if(strlen($password) < 6){

                  $error['password'] = 'password needs to be longer then 6 characters';


              }



              foreach ($error as $key => $value) {

                  if(empty($value)){

                      unset($error[$key]);

                  }



              }

              if(empty($error)){

                  register_user($first_name,$last_name,$username, $email, $password);

                  $data['message'] = $username;






              }





        if(isset($_POST['email'])) {

            $email = $_POST['email'];

            $length = 50;

            $token = bin2hex(openssl_random_pseudo_bytes($length));





                if($stmt = mysqli_prepare($connection, "UPDATE users SET confirmtoken='{$token}' WHERE user_email= ?")){

                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);


                    $mail = new PHPMailer();

                    $mail->isSMTP();
                    $mail->Host = Config::SMTP_HOST;
                    $mail->Username = Config::SMTP_USER;
                    $mail->Password = Config::SMTP_PASSWORD;
                    $mail->Port = Config::SMTP_PORT;
                    $mail->SMTPSecure = 'tls';
                    $mail->SMTPAuth = true;
                    $mail->isHTML(true);
                    $mail->CharSet = 'UTF-8';


                    $mail->setFrom('artur@arturtola.com', 'Artur Tolaa');
                    $mail->addAddress($email);

                    $mail->Subject = 'Auto Mania Confirmation';

                    $mail->Body = '<p>Hello please click to confirm

                    <a href="http://localhost:/cms/confirm.php?email='.$email.'&token='.$token.' ">http://localhost/cms/confirm.php?email='.$email.'&token='.$token.'</a>



                    </p>';


                    if($mail->send()){

                        $emailSent = true;

                    }




                }









        }










     }


?>


<?php  include "includes/navigation.php"; ?>




    <div class="container">

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                      <div class="form-group">
                          <label for="first_name" class="sr-only">first name</label>

                          <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter first name"

                          autocomplete="on"

                          value="<?php echo isset($first_name) ? $first_name : '' ?>">

                          <p><?php echo isset($error['first_name']) ? $error['first_name'] : '' ?></p>


                      </div>
                      <div class="form-group">
                          <label for="last_name" class="sr-only">Last name</label>

                          <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter Your Last Name"

                          autocomplete="on"

                          value="<?php echo isset($last_name) ? $last_name : '' ?>">

                          <p><?php echo isset($error['last_name']) ? $error['last_name'] : '' ?></p>


                      </div>

                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>

                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username"

                            autocomplete="on"

                            value="<?php echo isset($username) ? $username : '' ?>">

                            <p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>


                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>

                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" autocomplete="on" value="<?php echo isset($email) ? $email : '' ?>" >

                             <p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>

                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>

                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">

                            <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>


                        </div>

                        <input type="submit" name="resgister" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
