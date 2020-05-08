<?php include"includes/header.php"; ?>
<?php include"includes/db.php"; ?>
<?php include"includes/navigation.php"; ?>


            <div class="container">

                <div class="row">


                    <div class="col-md-8">

 <?php
           if(isset($_GET['category'])) {

                      $post_category_id=$_GET['category'];

                       if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ) {

                      $query =  "SELECT * FROM posts WHERE post_category_id= $post_category_id ";

                       } else {

                      $query = "SELECT * FROM posts WHERE post_category_id= $post_category_id AND post_status = 'published' ";

                               }

                      $select_all_posts_query = mysqli_query($connection,$query);

                          if(mysqli_num_rows($select_all_posts_query) <1) {

                              echo "<h1 class='text-center'>No posts avaiable</h1>";

                          }    else {

                          while($row =mysqli_fetch_assoc($select_all_posts_query) )
                                              {
                                          $post_id = $row['post_id'];
                                          $post_title = $row['post_title'];
                                          $post_user = $row['post_user'];
                                          $post_date = $row['post_date'];
                                          $post_tags = $row['post_tags'];
                                          $post_image= $row['post_image'];
                                          $post_content=substr($row['post_content'],0,150);
?>

                    <h2>

                      <a href="/cms/post/<?php echo $post_id; ?>"><?php echo $post_title ?></a>

                    </h2>

                    <p class="lead">

                     By <a href="/cms/author/<?php echo $post_user; ?>/<?php echo $post_id; ?>"target="_blank"><?php echo ucfirst($post_user) ?></a>

                    </p>
                    <p> Post Tags : <?php echo $post_tags ?></p>
                    <hr>
                    <hr>
                    <img class="img-responsive" src="/cms/images/<?php echo ImagePlaceholder($post_image);?>" alt="">
                    <hr>

                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>

                    <p><?php echo $post_content ?></p>
                   <a class="btn btn-primary" href="/cms/post/<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
                    <br>

<?php }    }    } else {




            header("Location: index.php");


                          }
?>





            </div>

<?php  include "includes/sidebar.php";   ?>

        </div>

<?php include "includes/footer.php"; ?>
