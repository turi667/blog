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


    $query = "SELECT * FROM posts WHERE post_user = '{$the_post_user}' ";

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




  <?php

                if(isset($_POST['create_comment'])) {

                $the_post_id = $_GET['p_id'];
                $comment_user = $_POST['comment_user'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];


                if(!empty($comment_user) && !empty($comment_email) && !empty($comment_content) ) {


                $query = "INSERT INTO comments (comment_post_id, comment_user, comment_email, comment_content, comment_status,comment_date)";

                $query .= "VALUES ($the_post_id ,'{$comment_user}', '{$comment_email}', '{$comment_content }', 'unapproved',now())";

                $create_comment_query = mysqli_query($connection,$query);

                if(!$create_comment_query ){

                    die('QUERY FAILED' . mysqli_error($connection));

                    }



                $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";

                $query .= "WHERE post_id = $the_post_id ";

                $update_comment_count = mysqli_query($connection,$query);




               } else {

              echo "<script>alert('Fields cannot be empty')</script>";
                       }



                    }



?>

            </div>




<?php include "includes/sidebar.php";?>

        </div>

        <hr>


<?php include "includes/footer.php";?>
