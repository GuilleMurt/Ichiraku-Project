<?php
include_once 'config/parameters.php';
include_once 'app/controllers/loginController.php';

// Incluir controladores, APIs, modelos y entradas de modelos
array_map(function($view_controller) { 
    
    include_once 'app/controllers/viewControllers/'.$view_controller; 

}, views_controller);

array_map(function($api) { 

    include_once 'app/controllers/api/'.$api; 

}, apis);

array_map(function($model) { 
    
    include_once 'app/models/'.$model; 

}, models);

if (isset($_GET['controller']) && $_GET['controller'] === 'home') {
    $controller = new homeController();
    $controller->index();
} else {
    $controller = new LoginController();
    if (isset($_GET['action']) && $_GET['action'] === 'logout') {
        $controller->logout();
    } else {
        $controller->index();
    }
}
    
?>
