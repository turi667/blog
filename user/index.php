<?php include "user_includes/user_header.php"; ?>

<div id="wrapper">

<?php

     $session =
     session_id();
     $time = time();
     $time_out_in_seconds = 60;
     $time_out = $time - $time_out_in_seconds;

     $query = "SELECT * FROM users_online WHERE session = '$session'";

     $send_query = mysqli_query($connection, $query);

     $count = mysqli_num_rows($send_query);

               if($count == NULL) {

                mysqli_query($connection, "INSERT INTO users_online(session,time) VALUES('$session','$time')");

               } else {

                mysqli_query($connection,"UPDATE  users_online SET time = '$time' WHERE session = '$session'");
                      }

     $users_online_query = mysqli_query($connection,"SELECT * FROM  users_online WHERE time > '$time_out' ");

     $count_user = mysqli_num_rows($users_online_query);

?>






        <!-- Navigation -->
       <?php include "user_includes/user_navigation.php"; ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                         Welcome
                            <small><?php echo $_SESSION['username'] ?></small>

                        </h1>

                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row -->

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                         <?php
                        $username = $_SESSION['username'];

                        $query = "SELECT * FROM posts WHERE post_user='$username'" ;

                        $select_all_post = mysqli_query($connection,$query);

                        $post_count = mysqli_num_rows($select_all_post);

                        echo "<div class='huge'>{$post_count}</div>"

                        ?>

                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

<?php

                    $query = "SELECT * FROM comments WHERE comment_author = '$username' ";

                    $select_all_comments = mysqli_query($connection,$query);

                    $comment_count = mysqli_num_rows($select_all_comments);

                    echo "<div class='huge'>{$comment_count}</div>"

?>

                      <div>Comments By Me</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>


</div>


<?php
          $query = "SELECT * FROM posts WHERE post_status = 'published' AND post_user = '$username'";

          $select_all_published_post = mysqli_query($connection,$query);

          $post_published_count = mysqli_num_rows($select_all_published_post);


          $query = "SELECT * FROM posts WHERE post_status = 'draft' AND post_user = '$username'";

          $select_all_draft_post = mysqli_query($connection,$query);

          $post_draft_count = mysqli_num_rows($select_all_draft_post);


          $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' AND comment_author = '$username'";

          $unapproved_comments_query = mysqli_query($connection,$query);

          $unapproved_comments_count = mysqli_num_rows($unapproved_comments_query);


?>



<div class="row">
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

      google.charts.load('visualization', "1.1", {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

       function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
            <?php

          $element_text = ['My Posts','Approved Posts','Unapproved Posts','Comments I made','Pending Comments'];
          $element_count = [$post_count,$post_published_count,$post_draft_count,$comment_count,$unapproved_comments_count];

          for($i = 0;$i < 5; $i++) {

              echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";


          }


         ?>


         // ['Posts', 1000],

        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "user_includes/user_footer.php"; ?>
