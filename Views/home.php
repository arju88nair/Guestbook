<?php
include_once 'header.php';
?>

<style>
    html, body {
        height: 100%;
    }

    #yellow {
        height: 100%;
        background: yellow;
    }

    .media {
        -webkit-box-shadow: 7px 13px 17px 0px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 7px 13px 17px 0px rgba(0, 0, 0, 0.75);
        box-shadow: 7px 13px 17px 0px rgba(0, 0, 0, 0.75);
        border-radius: 10px 10px 10px 10px;
        -moz-border-radius: 10px 10px 10px 10px;
        -webkit-border-radius: 10px 10px 10px 10px;
        border: 0px solid #000000;
        margin-bottom: 26px;
    }

    .media img {
        width: 16%;
    }
</style>
<div class="container-fluid h-100">
    <div class="row justify-content-center h-100">
        <div class="col-lg-7 ">
            <br>
            <?php
            foreach ($approvedPosts as $approvedPost) {
                echo '
                 <div class="media">
                <img class="mr-3" src="' . $approvedPost["image"] . '" alt="Generic placeholder image">
                <div class="media-body">
                    <h5 class="mt-0">' . $approvedPost["title"] . '</h5>
                    ' . substr($approvedPost["summary"], 0, 300) . '...' . '
                </div>
            </div>
            ';
            }
            ?>
        </div>
        <div class="col-5 hidden-md-down" id="yellow">
            XXXX
        </div>
    </div>
</div>
</body>
</html>
