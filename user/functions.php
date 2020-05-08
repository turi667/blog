<?php

      function allowed_image($post_image) {
        $allowed_ext = array('jpg','jpeg','png','gif');
        $file_ext = end(explode('.', $post_image));

        return (in_array($file_ext, $allowed_ext) == true) ? true : false;
      }

      
      function watermark_image($file, $destination){
        $watermark = imagecreatefrompng('watermark.png');
        $source = getimagesize($file);
        $source_mime = $source['mime'];
        if($source_mime == 'image/png'){ 
            
          $image = imagecreatefrompng($file);
        } else if ($source_mime == 'image/jpeg'){
            
          $image = imagecreatefromjpeg($file);
        } else if ($source_mime == 'image/gif'){
            
          $image = imagecreatefromgif($file);
        }
        imagecopy($image, $watermark, 10, 10, 0, 0, imagesx($watermark), imagesy($watermark));
        imagepng($image,$destination);
      }

function redirect($location){


    header("Location:" . $location);
    exit;

}


function ifItIsMethod($method=null){

    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){

        return true;

    }

    return false;

}

function isLoggedIn(){

    if(isset($_SESSION['user_role'])){

        return true;


    }


   return false;

}

function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){

    if(isLoggedIn()){

        redirect($redirectLocation);

    }

}





function escape($string) {

global $connection;

return mysqli_real_escape_string($connection, trim($string));


}



function set_message($msg){

if(!$msg) {

$_SESSION['message']= $msg;

} else {

$msg = "sucessful";


    }


}


function display_message() {

    if(isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }


}



function ImagePlaceholder($image=''){

 if(!$image){
     return 'automania.jpg';
 } else {
     return $image;
 }


}




function confirmQuery($result) {

    global $connection;

    if(!$result ) {

          die("QUERY FAILED ." . mysqli_error($connection));


      }


}


function is_subscriber($username) {

    global $connection;

    $query = "SELECT user_role FROM users WHERE username = '$username'";

    $result = mysqli_query($connection, $query);

    confirmQuery($result);

    $row = mysqli_fetch_array($result);


    if($row['user_role'] == 'subscriber'){

        return true;

    }else {


        return false;
    }

}
function is_admin($username) {

    global $connection;

    $query = "SELECT user_role FROM users WHERE username = '$username'";

    $result = mysqli_query($connection, $query);

    confirmQuery($result);

    $row = mysqli_fetch_array($result);


    if($row['user_role'] == 'admin'){

        return true;

    }else {


        return false;
    }

}
