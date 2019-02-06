<?php

include_once 'controllers/UserController.php';
include_once 'controllers/HomeController.php';

// Grabs the URI and breaks it apart in case we have querystring stuff
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
if (preg_match('/\.(?:png|jpg|jpeg|gif|js|css)$/', $_SERVER["REQUEST_URI"])) {
    return false;    // serve the requested resource as-is.
}
$homeController = new \controllers\HomeController();
$userController = new \controllers\UserController();
// Routing it up!
switch ($request_uri[0]) {
    case '/':
        return $userController->index();
        break;
    case '/home':
        return $homeController->index();
        break;
    case '/register':
        return $userController->doRegister();
        break;
    case '/login':
        return $userController->doLogin();
        break;
    case '/addPost':
        return $homeController->addPost();
        break;
    case '/admin':
        return $homeController->adminHome();
        break;
    case '/detailView':
        return $homeController->detailView();
        break;
    case '/editPost':
        return $homeController->editView();
        break;
    case '/logout':
        return $userController->doLogout();
        break;
    default:
        echo "sdsdd";
        break;
}
