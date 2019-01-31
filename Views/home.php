<?php
include_once 'footer.php';
?>

<style>
    .container {
        background: green;
    }

    .col-md-3 {
        background: pink;
    }
    .col-md-9 {
        background: yellow;
    }
    .col-md-6.blah {
        background: red;
    }
</style>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 ">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has </div>
        <div class="col-md-6 blah">
           blahs
        </div>
    </div>
</div>

</body>
</html>
