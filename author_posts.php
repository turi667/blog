<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "includes/navigation.php"; ?>


    <div class="container">

        <div class="row">



            <div class="col-md-8">

          <h1 class="page-header">
                    All posts Made By : <?php echo ucfirst($_GET['author']); ?>
          </h1>

<?php

    if(isset($_GET['p_id'])){

    $the_post_id = $_GET['p_id'];

    $the_post_user = $_GET['author'];

                             }

                 if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ) {

            
                     $query = "SELECT * FROM posts WHERE post_user = '{$the_post_user}' ";
                     



         } else {


             $query = "SELECT * FROM posts WHERE post_user = '{$the_post_user}'  AND post_status = 'published' ";

           
         }

   
    $select_all_posts_query = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_all_posts_query)) {

            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_user = $row['post_user'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_content = $row['post_content'];

?>



                <h2>
                    <a href="/cms/post/<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                </h2>

                 <p>Tags : <?php echo $post_tags ?></p>
                <hr>
                <hr>
                <img class="img-responsive" src="/cms/images/<?php echo ImagePlaceholder($post_image);?>" alt="">
                <hr>
                <p><span class="glyphicon glyphicon-time"></span>  Posted on<?php echo $post_date ?></p>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="/cms/post/<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>


 <?php } ?>





            </div>




<?php include "includes/sidebar.php";?>

        </div>

        <hr>


<?php include "includes/footer.php";?>
