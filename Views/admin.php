<?php
include_once 'partials/header.php';
?>

<style>
    html, body {
        height: 100%;

    }

    #yellow {

        height: 100%;
        /*border-left: 1px solid lightgrey;*/
        /*-webkit-box-shadow: 7px 13px 17px 0px rgba(0, 0, 0, 0.75);*/
        /*-moz-box-shadow: 7px 13px 17px 0px rgba(0, 0, 0, 0.75);*/

    }

    .media {

        -webkit-box-shadow: 7px 13px 17px 0px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 7px 13px 17px 0px rgba(0, 0, 0, 0.75);
        box-shadow: 7px 13px 17px 0px rgba(0, 0, 0, 0.75);
        border-radius: 10px 10px 10px 10px;
        -moz-border-radius: 10px 10px 10px 10px;
        -webkit-border-radius: 10px 10px 10px 10px;
        border: 1px solid lightgrey;
        margin-bottom: 26px;
        padding-bottom: 10px;
        padding-top: 10px;
    }

    .media img {
        width: 16%;
    }

    .btn-file {
        position: relative;
        overflow: hidden;
    }

    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }

    #img-upload {
        width: 50%;
    }
</style>
<div class="container-fluid h-100">
    <h4>Admin control</h4>
    <hr>
    <div class="row justify-content-center h-100">
        <div class="col-lg-6 ">
            <h4>Pending Posts</h4>
            <?php
            foreach ($approvedPosts as $approvedPost) {
                echo '
                 <div class="media">
                <img class="mr-3" src="' . $approvedPost["image"] . '" alt="Generic placeholder image">
                <div class="media-body">
                    <h5 class="mt-0">' . $approvedPost["title"] . '</h5>
                    ' . substr($approvedPost["summary"], 0, 300) . '...' . '
                     <br>
                    <div class="float-right">' . substr($approvedPost["created_at"], 0, -8) . " " . '&nbsp;</div><br>
                </div>
            </div>
            ';
            }
            ?>
        </div>
        <hr></hr>
        <div class="col-6 hidden-md-down" id="yellow">
            <h4>Approved Posts</h4>
            <div class="col-lg-12">
                <br>
                <?php
                foreach ($pendingPosts as $pendingPost) {
                    if ($pendingPost['approved']) {
                        $button = "<i class=\"fas fa-check-circle\"></i>";
                    } else {
                        $button = "<i class=\"fas fa-times-circle\"></i>";
                    }
                    echo '
                 <div class="media">
                <img class="mr-3" src="' . $pendingPost["image"] . '" alt="Generic placeholder image">
                <div class="media-body">
                    <h5 class="mt-0">' . $pendingPost["title"] . '</h5>
                    ' . substr($pendingPost["summary"], 0, 120) . '...' . '
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>
                      
                            ' . $button . '
                        </div>
                          <div>
                             ' . substr($pendingPost["created_at"], 0, -8) . " " . '&nbsp;
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
                            <input type="text" class="form-control" id="summary" placeholder="Enter summary"
                                   name="summary">
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
<script>
    $(document).ready(function () {
        $(document).on('change', '.btn-file :file', function () {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function (event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }

        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function () {
            readURL(this);
        });
    });
</script>
</body>
</html>
