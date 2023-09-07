<?php
require_once 'appHandler.php';
require_once 'lib/Figuras.php';
require_once 'lib/AreaFilter.php';
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']));


// lee la acción
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home'; // acción por defecto si no envían
}

$params = explode('/', $action);
require_once 'templates/header.php';
switch ($params[0]) {
    case 'home':
        showHome();
        break;

    case 'lista':
        if(empty($params[1]))
            showList();
        else
            showFigure($params[1]);
        break;
    
    case 'menor-a':
        if(empty($params[1]))
            show404();
        else
            showList($params[1]);
        break;
    
    case 'add':
        if (empty($params[1])) 
            showAddForm();
        else{
            if(empty($params[3]))
                addFigure($params[1], $params[2]);
            else
                addFigure($params[1], $params[2], $params[3]);
        }
        
        break;

    default:
        show404();
        break;
}
require_once 'templates/footer.php';