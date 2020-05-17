<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "includes/navigation.php"; ?>



    <div class="container">

        <div class="row">


            <div class="col-md-8">

<?php

// Searching based on the status of the posts and based on the ROLE of USER . If its Admin he can search anything, If User can check only what its published

            if(isset($_GET['submit'])){

            $search = $_GET['search'];


         if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ) {


            $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'  ";

            $search_query = mysqli_query($connection, $query);


         } else {


            $query = "SELECT * FROM posts WHERE  post_status = 'published' AND (post_tags LIKE '%$search%' OR post_title LIKE '%$search%' OR post_content LIKE '%$search%') ";

            $search_query = mysqli_query($connection, $query);

         }
            if(!$search_query) {

                die("QUERY FAILED" . mysqli_error($connection));

            }

            $count = mysqli_num_rows($search_query);

            if($count == 0) {

                echo "<h1> NO RESULT</h1>";

            } else {

                    while($row = mysqli_fetch_assoc($search_query)) {

                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_tags = $row['post_tags'];

        ?>




                <h2>
                    <a href="/cms/post/<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                </h2>

                <p class="lead">
                  By <a href="/cms/author/<?php echo $post_author ?>/<?php echo $post_id; ?>"><?php echo $post_author ?></a>
                </p>


                <p> Post Tags : <?php echo $post_tags; ?></p>
                <hr>
                <hr>
               <img class="img-responsive" src="/cms/images/<?php echo ImagePlaceholder($post_image);?>" alt="">
                <hr>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <p><?php echo $post_content ?></p>

                <a class="btn btn-primary" href="/cms/post/<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>


<?php                               }


                         }


              }


?>





            </div>





<?php include "includes/sidebar.php";?>


  </div>


        <hr>



<?php include "includes/footer.php";?>
