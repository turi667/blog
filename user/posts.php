<?php include "user_includes/user_header.php"; ?>

    <div id="wrapper">

<?php include "user_includes/user_navigation.php"; ?>

        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">


                <div class="row">
                  <div class="col-lg-12">
                         <h1 class="page-header" align="center">
                       My Posts

                      </h1>
<?php


if(isset($_GET['source'])){

    $source=$_GET['source'];

}       else {

    $source='';

}

  switch($source){
                  case 'add_post';
                  include "user_includes/add_post.php";
                  break;

                  default;
                  include "user_includes/view_all_posts.php";
                  break;
                }





?>
                        </div

                </div>


            </div>


        </div>


<?php include "user_includes/user_footer.php"; ?>
