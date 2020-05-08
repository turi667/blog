<?php
if(isset($_POST['create_user'])){



    $user_firstname=$_POST['user_firstname'];
    $user_lastname=$_POST['user_lastname'];
    $user_role=$_POST['user_role'];
    $username=$_POST['username'];
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];

        $error = [

          'user_password'=>'',
          'user_firstname'=>'',
          'user_lastname'=>'',
          'user_email'=>'',
          'username'=>''

                 ];


                 if($user_firstname ==''){

                    $error['user_firstname'] = 'User firstname cannot be empty';


                }
                if($user_lastname ==''){

                   $error['user_lastname'] = 'lastname  cannot be empty';


                         }

                  if(strlen($username) < 4){

                      $error['username'] = 'Username needs to be longer than 4';


                  }
                  if(strlen($username) > 10){

                      $error['username'] = 'Username needs to be shorter than 10 ';


                  }

                   if($username ==''){

                      $error['username'] = 'Username cannot be empty';


                  }


                   if(username_exists($username)){

                      $error['username'] = 'Username already exists, pick another another';


                  }



                  if($user_email ==''){

                      $error['user_email'] = 'Email cannot be empty';


                  }


                   if(email_exists($user_email)){

                      $error['user_email'] = 'Email already exists';


                  }


                  if($user_password == '') {


                    $error['user_password'] = 'Password cannot be empty';

                  }

                  if(strlen($user_password) < 6){

                   $error['user_password'] = 'password needs to be longer then 6 characters';


                  }



                  foreach ($error as $key => $value) {

                      if(empty($value)){

                          unset($error[$key]);

                      }



                  }

        if(empty($error)){

            $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));

            $query= "INSERT INTO users(user_firstname,user_lastname,user_role,username,user_email,user_password)";

            $query.= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_password}')";


            $create_user_query=mysqli_query($connection,$query);

            confirmQuery($create_user_query);

            echo "User Created: " . " " . "<a href='users.php'>View Users</a>";
         }


        }
?>


 <form action="" method="post" enctype="multipart/form-data">



      <div class="form-group">
         <label for="title">Firstname</label>
          <input type="text" class="form-control" name="user_firstname"   value="<?php echo isset($user_firstname) ? $user_firstname : '' ?>">
           <p><?php echo isset($error['user_firstname']) ? $error['user_firstname'] : '' ?></p>
      </div>



       <div class="form-group">
         <label for="post_status">Lastname</label>
          <input type="text" class="form-control" name="user_lastname"   value="<?php echo isset($user_lastname) ? $user_lastname : '' ?>">
       <p><?php echo isset($error['user_lastname']) ? $error['user_lastname'] : '' ?></p>
      </div>


         <div class="form-group">

       <select name="user_role" id="">
        <option value="subscriber">Select Options</option>
          <option value="admin">Admin</option>
          <option value="subscriber">Subscriber</option>


       </select>




      </div>

<!--
      <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>
-->

      <div class="form-group">
         <label for="post_tags">Username</label>
          <input type="text" class="form-control" name="username"  value="<?php echo isset($username) ? $username : '' ?>">
 <p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
      </div>

      <div class="form-group">
         <label for="post_content">Email</label>
          <input type="email" class="form-control" name="user_email"  value="<?php echo isset($user_email) ? $user_email : '' ?>">
      <p><?php echo isset($error['user_email']) ? $error['user_email'] : '' ?></p>
    </div>

      <div class="form-group">
         <label for="post_content">Password</label>
          <input type="password" class="form-control" name="user_password">
 <p><?php echo isset($error['user_password']) ? $error['user_password'] : '' ?></p>
      </div>




       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
      </div>


</form>
