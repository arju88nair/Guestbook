<?php

include_once 'routes/Request.php';
include_once 'routes/Router.php';
include_once 'controllers/UserController.php';
include_once 'controllers/HomeController.php';
$router = new Router(new Request);


$router->get('/', function () {
    $userController = new \controllers\UserController();
    return $userController->index();
});

$router->get('/home', function () {
    $homeController = new \controllers\HomeController();
    return $homeController->index();
});


$router->post('/register', function () {
    $userController = new \controllers\UserController();
    return $userController->doRegister();
});

$router->post('/login', function () {
    $userController = new \controllers\UserController();
    return $userController->doLogin();
});


$router->post('/addPost', function () {
    $homeController = new \controllers\HomeController();
    return $homeController->addPost();
});

$router->get('/admin', function () {
    $homeController = new \controllers\HomeController();
    return $homeController->adminHome();
});

$router->get('/detailView', function () {
    $homeController = new \controllers\HomeController();
    return $homeController->detailView();
});

$router->get('/editView', function () {
    $homeController = new \controllers\HomeController();
    return $homeController->editView();
});

