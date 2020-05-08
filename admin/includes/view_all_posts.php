<?php


if(isset($_POST['checkBoxArray'])) {

   foreach($_POST['checkBoxArray'] as $postValueId){
   $bulk_options=$_POST['bulk_options'];

   switch($bulk_options){

           case 'published';
           $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id='{$postValueId}'";
           $update_to_published_status = mysqli_query($connection,$query);

           break;

           case 'draft';
           $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id='{$postValueId}'";
           $update_to_draft_status = mysqli_query($connection,$query);

           break;

           case 'delete';
           $query = " DELETE  FROM posts WHERE post_id={$postValueId} ";
           $update_to_delete_status = mysqli_query($connection,$query);
           confirmQuery($update_to_delete_status);

           break;


      }
    }
 }
?>

        <form action="" method="post">

        <table class="table table-bordered table-hover">
        <div id="bulkOptionContainer" class="col-xs-4">

         <select class="form-control" name="bulk_options" id="">

         <option value="">Select Options</option>
         <option value="published">Publish</option>
         <option value="draft">Draft</option>
         <option value="delete">Delete</option>

         </select>
            </div>
        <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a class="btn btn-primary" href="posts.php?source=add_post">Add New </a>
        </div>




                            <thead>
                            <tr>
                                <th><input id="selectAllBoxes" type="checkbox"></th>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Tags</th>
                                <th>Comments</th>
                                <th>Date </th>
                                <th>View</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Views</th>
                            </tr>
                            </thead>
                            <tbody>

<?php


$query ="SELECT posts.post_id, posts.post_user, posts.post_title, posts.post_category_id, posts.post_status, posts.post_image,";

$query .= " posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_views_count, categories.cat_id, categories.cat_title  ";

$query .=" FROM posts ";

$query .=" LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC ";

$select_posts = mysqli_query($connection, $query);


                            while ($row = mysqli_fetch_assoc($select_posts)) {

                                    $post_id          = $row['post_id'];
                                    $post_user        = $row['post_user'];
                                    $post_title       = $row['post_title'];
                                    $post_category_id = $row['post_category_id'];
                                    $post_status      = $row['post_status'];
                                    $post_image       = $row['post_image'];
                                    $post_tags        = $row['post_tags'];
                                    $post_comment_count = $row['post_comment_count'];
                                    $post_date        = $row['post_date'];
                                    $post_views_count = $row['post_views_count'];
                                    $category_title   = $row['cat_title'];
                                    $category_id      = $row['cat_id'];

                                    echo "<tr>";
                                ?>
                                   <td><input class='checkBoxes' id="selectAllBoxes" type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
                                <?php
                                    echo "<td>{$post_id}</td>";

                                    echo "<td>$post_user</td>";

                                    echo "<td>{$post_title}</td>";

                                    echo "<td>{$category_title}</td>";

                                    echo "<td>{$post_status}</td>";

                                    echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";

                                    echo "<td>{$post_tags}</td>";



                                $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";

                                $send_comment_query = mysqli_query($connection, $query);

                                $count_comments = mysqli_num_rows($send_comment_query);

                                    echo "<td>{$count_comments}</td>";

                                    echo "<td>{$post_date}</td>";
                                    echo "<td><a class='btn btn-primary' href='../post/$post_id' target='_blank'>View</a></td>";
                                    echo "<td><a class='btn btn-info'href='posts.php?source=edit_post&p_id={$post_id}' target='_blank' >Edit</a></td>";
                                    echo "<td><a class ='btn btn-danger' onClick=\"javascript: return confirm('Are you sure you want to delete');\" href='posts.php?delete={$post_id}'>Delete</a></td>";
                                    echo "<td><a class ='btn btn-warming' onClick=\"javascript: return confirm('Are you sure you want to Reset Post Views Count To 0');\" href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";
                                    echo "</tr>";


                   }
?>

                                        </tbody>
                                        </table>
    </form>

<?php
          if(isset($_GET['delete'])){

              $the_post_id =$_GET['delete'];

              $query="DELETE FROM posts WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['delete']) . " ";

              $delete_query=mysqli_query($connection,$query);

             header("Location: posts.php");
          }

          if(isset($_GET['reset'])){

              $the_post_id =$_GET['reset'];

              $query="UPDATE posts SET post_views_count = 0  WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['reset']) . " ";

              $reset_query=mysqli_query($connection,$query);

             header("Location: posts.php");
          }


?>
