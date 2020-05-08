
<?php error_reporting(0);


//creating post . POST author its the session username,post status is draft should be accepted by the Admin of page

   if(isset($_POST['create_post'])) {

            $post_title  = $_POST['title'];
            $post_user = $_SESSION['username'];
            $post_category_id = $_POST['post_category'];
            $post_tags=$_POST['post_tags'];
            $post_content=$_POST['post_content'];
            $post_date=date('d-m-y');
            $post_image=$_FILES['image']['name'];
            $post_image_temp=$_FILES['image']['tmp_name'];

//WATERMARKING our photos with the automania logo once they are uploaded to the page

            if (allowed_image($post_image) == true){

                $post_image = md5(microtime(true)).'.png';

                watermark_image($post_image_temp,'../images/'.$post_image);

                } else {
                  echo 'No photo added or the file type not accepted';
                }




            $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date,post_image,post_content,post_tags,post_status) ";

            $query .= "VALUES({$post_category_id},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}', 'draft') ";

            $create_post_query = mysqli_query($connection, $query);

            confirmQuery($create_post_query);

            $the_post_id = mysqli_insert_id($connection);


            echo "<p class='bg-success'>Post Created.It Will be published once confirmed by admin</p>";



         }




?>


    <form action="" method="post" enctype="multipart/form-data">


      <div class="form-group">
         <label for="title">Post Title</label>
          <input type="text" class="form-control" name="title">
      </div>

         <div class="form-group">
       <label for="category">Category</label>
       <select name="post_category" id="">

<?php

        $query = "SELECT * FROM categories";

        $select_categories = mysqli_query($connection,$query);

        confirmQuery($select_categories);


        while($row = mysqli_fetch_assoc($select_categories )) {

        $cat_id = $row['cat_id'];

        $cat_title = $row['cat_title'];


            echo "<option value='$cat_id'>{$cat_title}</option>";

                                                              }

?>


       </select>

      </div>


      <div class="form-group">
         <label for="users">Posted By</label>
          <input type="text" class="form-control" name="post_users" value="<?php echo $_SESSION['username'];?>" disabled>
      </div>


   <div class="form-group">
         <label for="post_status">Post Status(Needs Confirmation By Page ADMIN)</label>
          <input type="text" class="form-control" name="post_status" value="draft" disabled>
      </div>



    <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>

      <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" class="form-control" name="post_tags">
      </div>

     <div class="form-group">
<label for="post_content">Post Content</label>
<textarea class="form-control" name="post_content" id="body" cols="30" rows="10"></textarea>

<script>

ClassicEditor
.create( document.querySelector( '#body' ) )
.catch( error => {
console.error( error );
} );
</script>
</div>


       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
      </div>


</form>
