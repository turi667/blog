
<?php
if(!isset($_GET['edit_comment'])){

    redirect('index');

}

if(isset($_GET['edit_comment'])){


          $the_comment_id =$_GET['edit_comment'];

          $username = $_SESSION['username'];

          $query = "SELECT * FROM comments WHERE comment_id = $the_comment_id AND comment_author='$username'";

          $select_comment_query = mysqli_query($connection,$query);

          while($row = mysqli_fetch_assoc($select_comment_query)) {

          $comment_id = $row['comment_id'];
          $comment_post_id = $row['comment_post_id'];
          $comment_author = $row['comment_author'];
          $comment_email = $row['comment_email'];
          $comment_content = $row['comment_content'];
          $comment_status = $row['comment_status'];
          $comment_date = $row['comment_date'];

      }


if(isset($_POST['edit'])){


          $comment_content   = ($_POST['comment_content']);

          $query  = "UPDATE comments SET ";

          $query .= "comment_content  = '{$comment_content}' ";

          $query .= "WHERE comment_id = {$the_comment_id} ";

          $edit_comment_query = mysqli_query($connection,$query);

          confirmQuery($edit_comment_query);


          echo "Comment Updated";


                           }


                       }

 else {

        header("Location: index.php");


      }

?>

    <form action="" method="post" enctype="multipart/form-data">


      <div class="form-group">
          <label for="comment_content_content">Comment Content</label>
            <textarea name="comment_content"  class="form-control" rows="3"><?php echo $comment_content;?></textarea>

      </div>

     <div class="form-group">
          <input class="btn btn-primary" type="submit" name="edit" value="Edit Comment">
      </div>


   </form>
