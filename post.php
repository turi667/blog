<?php include "includes/header.php";?>
<?php include "includes/db.php";?>
<?php include "includes/navigation.php";?>


    <div class="container">

        <div class="row">


            <div class="col-md-8">
 <?php

 //using the SUPER GLOBAL GET to get the post_id(p-id) also when post is clicked everytime the post view its updated to the DB by +1

        if (isset($_GET['p_id']))
        {
            $the_post_id = $_GET['p_id'];

            $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id=$the_post_id";

            $send_query = mysqli_query($connection, $view_query);

            if (!$send_query)
            {
                die("Query Failed");
            }
            if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin')
            {
                $query = "SELECT * FROM posts WHERE post_id= $the_post_id ";
            }
            else
            {

                $query = "SELECT * FROM posts WHERE post_id= $the_post_id AND post_status = 'published' ";
            }

            $select_all_posts_query = mysqli_query($connection, $query);

            if (mysqli_num_rows($select_all_posts_query) < 1)

            {
                echo "<h1 class='text-center'> No posts available </h1>";
            }
            else
            {
                while ($row = mysqli_fetch_assoc($select_all_posts_query))
                {
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

                                 By <a href="/cms/author/<?php echo $post_author; ?>/<?php echo $post_id; ?>"target="_blank"><?php echo ucfirst($post_author) ?></a>

                                </p>
                                <p> Post Tags : <?php echo $post_tags ?></p>
                                <hr>
                                <hr>
                                <img class="img-responsive" src="/cms/images/<?php echo ImagePlaceholder($post_image);?>" alt="">
                                <hr>

                                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>

                                <p><?php echo $post_content ?></p>


                                <hr>
<?php  } ?>




<?php  //Only logged in users can comment and if the session is not started UI wont be ablo to see the add comment section

        if (isset($_POST['create_comment']))
        {

            $the_post_id = $_GET['p_id'];

            $comment_author = $_SESSION["username"];

            $comment_content = $_POST['comment_content'];

            if (!empty($comment_author) && !empty($comment_content))
            {

    $query = "INSERT INTO comments (comment_post_id,comment_author,comment_content,comment_status,comment_date)";

    $query .= "VALUES ($the_post_id,'{$comment_author}','{$comment_content}','unapproved',now())";

    $create_comment_query = mysqli_query($connection, $query);
 echo "Comment was succesfully added. Once its confirmed by admin it will be published";
                if (!$create_comment_query)
                {
                    die('QUERY FAILED' . mysqli_error($connection));
                }

                $query = "UPDATE posts SET post_comment_count= post_comment_count + 1 ";

                $query .= " WHERE post_id=$the_post_id ";

                $update_comment_count = mysqli_query($connection, $query);



            }
            else
            {
                echo "<script>alert('fields cannot be empty')</script>";
            }
        }

?>



<?php if(isset($_SESSION['username'])):?>

                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form  action="" method="post" role="form">

                         <div class="form-group">
                             <label for="Email">By</label>
                            <input type="text" class="form-control" name="comment_username" value="<?php echo $_SESSION['username']; ?>" disabled>
                        </div>
                             <div class="form-group">
                              <label for="Comment">Your Comment</label>
                            <textarea name="comment_content"  class="form-control" rows="3"></textarea>
                           </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>
<?php endif;?>
                <hr>


<?php
        $query = "SELECT * FROM comments WHERE comment_post_id ={$the_post_id}";

        $query .= " AND comment_status='approved'";

        $query .= " ORDER BY comment_id DESC ";

        $select_comment_query = mysqli_query($connection, $query);

        if (!$select_comment_query)
        {
            die('Query Failed' . mysqli_error($connection));
        }
        while ($row = mysqli_fetch_array($select_comment_query))
        {
            $comment_date = $row['comment_date'];
            $comment_content = $row['comment_content'];
            $comment_author = $row['comment_author'];

?>


                <div class="media">

                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Commented By <?php echo $comment_author;?> on   <?php echo $comment_date;     ?>

                          </h4>
                          <h4>
                        <?php echo $comment_content;   ?>
                      </h4>
                    </div>

                </div>








<?php } } }

else {
    header("Location: index.php");
     }

?>


            </div>

<?php include "includes/sidebar.php"; ?>

        </div>


        <hr>

<?php include "includes/footer.php"; ?>
