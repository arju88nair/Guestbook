<?php
include_once 'header.php';
?>
<!-- Navigation -->

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

            <!-- Title -->
            <h1 class="mt-4"><?php echo $post['title'] ?></h1>

            <!-- Author -->
            <p class="lead">
                by
                <a href="#"><?php echo $post['username'] ?>p</a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p>Posted on <?php echo $post['created_at'] ?></p>

            <hr>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Edit Post
            </button>
            <hr>


            <!-- Preview Image -->
            <img class="img-fluid rounded" src=<?php echo $post['image'] ?> alt="">

            <hr>

            <!-- Post Content -->
            <p class="lead"><?php echo $post['summary'] ?></p>


            <hr>

            <!-- Comments Form -->
            <div class="card my-4">
                <h5 class="card-header">Leave a Comment:</h5>
            </div>
            <div id="disqus_thread"></div>
            <script>

                /**
                 *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                 *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                /*
                var disqus_config = function () {
                this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                };
                */
                (function () { // DON'T EDIT BELOW THIS LINE
                    var d = document, s = d.createElement('script');
                    s.src = 'https://guestbook-2.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered
                    by Disqus.</a></noscript>


            <!-- Comments -->


        </div>


    </div>
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit <?php echo $post['title'] ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="/editPost" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="email">Title:</label>
                            <input type="text" class="form-control" id="title"
                                   value="<?php echo $post['title'] ?>" name="title">
                        </div>
                        <div class="form-group">
                            <label for="email">Summary:</label>
                            <textarea class="form-control" id="summary" placeholder="Enter summary"
                                      name="summary"><?php echo $post['summary'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Upload Image</label>
                            <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    Browse… <input type="file" id="imgInp" name="image">
                                </span>
                            </span>
                                <input type="text" class="form-control" readonly>
                            </div>
                            <img id='img-upload' src="<?php echo $post['image'] ?>"/>
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
<script src="/resources/js/upload.js"></script>
<link rel="stylesheet" href="/resources/css/upload.css">
</body>
</html>