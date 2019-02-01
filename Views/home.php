<?php
include_once 'header.php';
?>

<style>
    html, body {
        height: 100%;

    }

    #yellow {

        height: 100%;
        border-left: 1px solid lightgrey;
        -webkit-box-shadow: 7px 13px 17px 0px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 7px 13px 17px 0px rgba(0, 0, 0, 0.75);

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
</style>
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
        <div class="col-5 hidden-md-down" id="yellow">
            <h4>My Posts</h4>
            <div class="col-lg-12">
                <br>
                <?php
                foreach ($userPosts as $userPosts) {
                    echo '
                 <div class="media">
                <img class="mr-3" src="' . $userPosts["image"] . '" alt="Generic placeholder image">
                <div class="media-body">
                    <h5 class="mt-0">' . $userPosts["title"] . '</h5>
                    ' . substr($userPosts["summary"], 0, 120) . '...' . '
                    <br>
                                       <div class="float-right">' . substr($userPosts["created_at"], 0, -8) . " " . '&nbsp;</div><br>

                </div>
            </div>
            ';
                }
                ?>
            </div>

        </div>
    </div>
</div>
</body>
</html>
