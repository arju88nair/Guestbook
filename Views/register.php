<!DOCTYPE HTML>
<html>
<head>
    <title>Web Programming using PHP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <!--    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
    <link rel="stylesheet" type="text/css" href="/resources/css/register.css"/>
</head>
<body>
<?php
// Error messages
if (count($data) > 0) {
    foreach ($data as $error) {
        echo "  <div class=\"alert alert-danger alert-dismissible\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
  <strong>Erorr!</strong> $error.
</div>";
    }
}

//Success messages
if (count($success) > 0) {
    foreach ($success as $item) {
        echo "  <div class=\"alert alert-success alert-dismissible\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
  <strong>Erorr!</strong> $item.
</div>";
    }
}
?>
<div class="form-wrap">
    <div class="tabs">
        <h3 class="signup-tab"><a class="active" href="#signup-tab-content">Sign Up</a></h3>
        <h3 class="login-tab"><a href="#login-tab-content">Login</a></h3>
    </div><!--.tabs-->

    <div class="tabs-content">
        <div id="signup-tab-content" class="active">
            <form class="signup-form" action="register" method="post">
                <input type="email" class="input" id="user_email" name="user_email" autocomplete="off"
                       placeholder="Email">
                <input type="text" class="input" id="user_name" name="user_name" autocomplete="off"
                       placeholder="Username">
                <input type="password" class="input" id="user_pass" name="user_pass" autocomplete="off"
                       placeholder="Password">
                <input type="submit" class="button" value="Sign Up">
            </form><!--.login-form-->
            <div class="help-text">
                <p>By signing up, you agree to our</p>
                <p><a href="#">Terms of service</a></p>
            </div><!--.help-text-->
        </div><!--.signup-tab-content-->

        <div id="login-tab-content">
            <form class="login-form" action="/login" method="post">
                <input type="text" class="input" id="user_login" name="user_email" autocomplete="off"
                       placeholder="Email or Username">
                <input type="password" class="input" id="user_pass" name="user_pass" autocomplete="off"
                       placeholder="Password">
                <input type="submit" class="button" value="Login">
            </form><!--.login-form-->
            <div class="help-text">
                <p><a href="#">Forget your password?</a></p>
            </div><!--.help-text-->
        </div><!--.login-tab-content-->
    </div><!--.tabs-content-->
</div><!--.form-wrap-->
</body>
<script src="/resources/js/register.js"></script>
</html>