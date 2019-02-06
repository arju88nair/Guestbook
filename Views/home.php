<?php
include_once 'partials/header.php';
?>
<link rel="stylesheet" href="/resources/css/upload.css">

<div class="container-fluid h-100">
    <div class="row justify-content-center h-100">
        <div class="col-lg-7 ">

            <br>
            <h4>Public Posts</h4>

            <?php
            foreach ($approvedPosts as $approvedPost) {
                echo '
                 <div class="media">
                <img class="mr-3" src="' . $approvedPost["image"] . '" alt="Generic placeholder image">
                <div class="media-body">
                    <h5 class="mt-0"><a href="/detailView?id=' . $approvedPost["id"] . '">' . $approvedPost["title"] . '</a></h5>
                    ' . substr($approvedPost["summary"], 0, 300) . '...' . '
                     <br>
                    <div class="float-right">' . substr($approvedPost["created_at"], 0, -8) . " " . '&nbsp;</div><br>
                </div>
            </div>
            ';
            }
            ?>
        </div>
        <div class="col-5 hidden-md-down" id="yellow">
            <br>
            <h4>My Posts
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    Add Post
                </button>
            </h4>
            <div class="col-lg-12">
                <?php
                foreach ($userPosts as $userPost) {
                    if ($userPost['approved']) {
                        $button = "<i class=\"fas fa-check-circle\"></i>";
                    } else {
                        $button = "<i class=\"fas fa-times-circle\"></i>";
                    }
                    echo '
                 <div class="media">
                <img class="mr-3" src="' . $userPost["image"] . '" alt="Generic placeholder image">
                <div class="media-body">
                    <h5 class="mt-0"><a href="/detailView?id=' . $userPost["id"] . '">' . $userPost["title"] . '</a></h5>
                    ' . substr($userPost["summary"], 0, 120) . '...' . '
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>
                      
                            ' . $button . '
                        </div>
                          <div>
                             ' . substr($userPost["created_at"], 0, -8) . " " . '&nbsp;
                          </div>
                    </div>
           </div>
        </div>
            ';
                }
                ?>
            </div>

        </div>
    </div>
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Create a new post</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="/addPost" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="email">Title:</label>
                            <input type="text" class="form-control" id="title" placeholder="Enter title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="email">Summary:</label>
                            <textarea class="form-control" id="summary" placeholder="Enter summary"
                                      name="summary"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Upload Image</label>
                            <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    Browse… <input type="file" id="imgInp" name="image"
                                                   accept="image/x-png,image/gif,image/jpeg">
                                </span>
                            </span>
                                <input type="text" class="form-control" readonly>
                            </div>
                            <img id='img-upload'/>
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
</div>
<script src="/resources/js/upload.js"></script>
</body>
</html>
