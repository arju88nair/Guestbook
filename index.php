<?php

include_once 'routes/Request.php';
include_once 'routes/Router.php';
include_once 'controllers/UserController.php';
$router = new Router(new Request);

$router->get('/', function () {
    return \Controllers\UserController::index();
});

