<?php

class Router{

    function __construct($route){
        
        /*structure d'une route
            /controllerName/actionOfTheController/id
        */

        $route = trim($route, '/');
        $route = filter_var($route, FILTER_SANITIZE_URL);
        $route = explode('/', $route);

        $controllerName = array_shift($route);
        
        /*structure des noms de fichiers correspondants aux controllers 
            nameOfTheController.controller.php
        */

        $controllerFilePath = "controller/$controllerName.controller.php";

        if(!file_exists($controllerFilePath)){
            header("Location: /error404");
            die;
        }

        /*structure des noms de classes correspondants aux controllers 
            NameController
        */

        $controllerClassName = ucfirst($controllerName)."Controller";
        $this->controller = new $controllerClassName($route);
        
    }

    function render(){
        return $this->controller->content;
    }

}

?>
