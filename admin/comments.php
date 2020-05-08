<?php
include "includes/admin_header.php";
?>

    <div id="wrapper">


       <?php
include "includes/admin_navigation.php";
?>
  =
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">


                <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header" align="center">
                       Comment Section
                      </h1>
<?php


if(isset($_GET['source'])){
    $source=$_GET['source'];
}       else {
    $source='';
}

  switch($source){
          case 'add_post';
          include "includes/add_post.php";
          break;

          case'edit_comment';
          include "includes/edit_comment.php";
          break;

          default;
          include "includes/view_all_comments.php";
          break;
  }





?>
                        </div

                </div>


            </div>


        </div>


<?php include "includes/admin_footer.php"; ?>
