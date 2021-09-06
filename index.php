<?php

function autoload($className){
    if (strpos($className, "Controller")) {
        $fileName = lcfirst(str_replace("Controller", "", $className));
        require_once "controller/$fileName.controller.php";
    }
    else if (strpos($className, "Repository")){
        $fileName = lcfirst(str_replace("Repository", "", $className));
        require_once "repository/$fileName.repository.php";
    } 
    else {
        $fileName = lcfirst($className);
        require_once "entity/$fileName.entity.php";
    }
}
spl_autoload_register("autoload");

$route = $_SERVER["REQUEST_URI"];
require_once 'router.php';
$router = new Router($route);

?>

<header>
    HEADER
</header>

<main>
    <?= $router->render() ?>
</main>

<footer>
    FOOTER
</footer>