<?php include "user_includes/user_header.php"; ?>



<?php



    if(isset($_SESSION['username'])) {

          $username = $_SESSION['username'];

          $query = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";

          $select_user_profile_query = mysqli_query($connection,$query);

          while($row = mysqli_fetch_array($select_user_profile_query)){
                  $user_id = $row['user_id'];
                  $username = $row['username'];
                  $first_name = $row['user_firstname'];
                  $last_name = $row['user_lastname'];
                  $user_email = $row['user_email'];
                  $get_password = $row['user_password'];


               }


          }

          if(isset($_POST['update_profile'])) {

              $first_name = $_POST['first_name'];
              $last_name = $_POST['last_name'];
              $post_password = $_POST['password'];
              $user_email = $_POST['user_email'];
              $oldpassword = $_POST['oldpassword'];
             
              $error = [

                'user_password'=>'',
                'user_firstname'=>'',
                'user_email'=>'',
                'oldpassword'=>'',
                'password'=>'',
                'user_lastname'=>''



                       ];


              if($first_name ==''){

              $error['first_name'] = 'User firstname cannot be empty';


                    }
              if($last_name ==''){

              $error['last_name'] = 'lastname  cannot be empty';


                    }
                  if($user_email ==''){

              $error['user_email'] = 'User email cannot be empty';


                    }
                         
                if (!password_verify($oldpassword,$get_password)  && !empty($oldpassword))  {

              $error['oldpassword'] = 'Sorry Old password Dont match ';


                    }
              foreach ($error as $key => $value) {

              if(empty($value)){

                    unset($error[$key]);

                }



          }

     if($post_password != $get_password && !empty($post_password)) {
         
      if(strlen($post_password) < 6){

         $error['password'] = 'password needs to be longer then 6 characters';


       }  

         
         else {

        $password = password_hash($post_password, PASSWORD_BCRYPT, array("cost" => 10));

        }
    } else {

        $password = $get_password;

    }

if(empty($error)){



    $edit_user_query = mysqli_query($connection, "UPDATE users SET user_firstname = '$first_name',user_email = '$user_email', user_lastname = '$last_name', user_password = '$password' WHERE user_id = $user_id" );

    confirmQuery($edit_user_query);



} 
          }
?>

    <div id="wrapper">


<?php include "user_includes/user_navigation.php"; ?>

        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">


                <div class="row">
                    <div class="col-lg-12">
                      <h1 class="page-header">  My Profile </h1>
                       <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">

                           <label for="first_name">First Name</label>

                           <input value="<?php echo $first_name; ?>" id="first_name" type="text" class="form-control" name="first_name">

                           <p><?php echo isset($error['first_name']) ? $error['first_name'] : '' ?></p>

                        </div>

                        <div class="form-group">

                            <label for="last_name">Last Name</label>

                            <input value="<?php echo $last_name; ?>" id="last_name" type="text" class="form-control" name="last_name">

                            <p> <?php echo isset($error['last_name']) ? $error['last_name'] : '' ?></p>

                        </div>

                        <div class="form-group">

                            <label for="username">Username</label>

                            <input value="<?php echo $username; ?>" id="" type="text" class="form-control" name="username" disabled>

                        </div>

                        <div class="form-group">

                            <label for="user_email">Email</label>

                            <input value="<?php echo $user_email; ?>" class="form-control" id="user_email" type="email" name="user_email" >
                             <p> <?php echo isset($error['user_email']) ? $error['user_email'] : '' ?></p>


                        </div>

                        <div class="form-group">

                            <label for="oldpassword">Old Password</label>

                            <input autocomplete="off" id="oldpassword" type="password" class="form-control" name="oldpassword" placeholder="Old Password">
                            
                        <p> <?php echo isset($error['oldpassword']) ? $error['oldpassword'] : '' ?></p>

                        </div>
                        <div class="form-group">

                            <label for="password">Password</label>

                            <input autocomplete="off" id="password" type="password" class="form-control" name="password" placeholder="New Password">
                            
                        <p> <?php echo isset($error['password']) ? $error['password'] : '' ?></p>

                        </div>
                           

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="update_profile">Update Profile</button>
                        </div>
                    </form>

               </div

                </div>


            </div>

        </div>


<?php include "user_includes/user_footer.php"; ?>
