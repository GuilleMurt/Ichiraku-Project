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

// Verificar si el parámetro 'controller' está definido en la URL
if (isset($_GET['controller'])) {
    $nombre_controller = $_GET['controller'] . 'Controller';

    // Verificar si la clase del controlador existe
    if (class_exists($nombre_controller)) {
        // Crear una instancia del controlador
        $controller = new $nombre_controller;

        // Verificar si se especifica una acción en la URL
        if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
            $action = $_GET['action'];
        } else {
            $action = action_default;
        }

        // Llamar a la acción en el controlador
        $controller->$action();
    } else {
        // Si el controlador no existe, redirigir al login
        $controller = new LoginController();
        if (isset($_GET['action']) && $_GET['action'] === 'logout') {
            $controller->logout();
        } else {
            $controller->index();
        }
    }
} else {
    // Si no se especifica un controlador, redirigir al login
    $controller = new LoginController();
    if (isset($_GET['action']) && $_GET['action'] === 'logout') {
        $controller->logout();
    } else {
        $controller->index();
    }
}
    
?>
