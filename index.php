<?php

include_once 'controllers/UserController.php';
include_once 'controllers/HomeController.php';

// Grabs the URI and breaks it apart in case we have querystring stuff
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
if (preg_match('/\.(?:png|jpg|jpeg|gif|js|css)$/', $_SERVER["REQUEST_URI"])) {
    return false;    // serve the requested resource as-is.
}

// Routing it up!
switch ($request_uri[0]) {
    case '/':
        $userController = new \controllers\UserController();
        return $userController->index();
        break;
    case '/home':
        $homeController = new \controllers\HomeController();
        return $homeController->index();
        break;
    case '/register':
        $userController = new \controllers\UserController();
        return $userController->doRegister();
        break;
    case '/login':
        $userController = new \controllers\UserController();
        return $userController->doLogin();
        break;
    case '/addPost':
        $homeController = new \controllers\HomeController();
        return $homeController->addPost();
        break;
    case '/admin':
        $homeController = new \controllers\HomeController();
        return $homeController->adminHome();
        break;
    case '/detailView':
        $homeController = new \controllers\HomeController();
        return $homeController->detailView();
        break;
    case '/editPost':
        $homeController = new \controllers\HomeController();
        return $homeController->editView();
        break;
    default:
        header('Location : ');
        require '../views/404.php';
        break;
}
