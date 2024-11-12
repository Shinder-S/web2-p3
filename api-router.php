<?php

require_once './libs/router.php';
require_once './app/controller/professionalsController.php';
require_once './app/model/professionalsModel.php';
require_once './app/view/apiView.php';

$router = new Router();

$router->addRoute('professionals', 'GET', 'professionalsController', 'showAll');
$router->addRoute('professionals/:ID', 'GET', 'professionalsController', 'showProfessionalById');

$router->addRoute('professionals', 'POST', 'professionalsController', 'add');
$router->addRoute('professionals/:ID', 'PUT', 'professionalsController', 'update');
$router->addRoute('professionals/:ID', 'DELETE', 'professionalsController', 'delete');

$router->addRoute('professionals/filter/:year', 'GET', 'professionalsController', 'filterByYear');

$router->route($_GET['resourse'], $_SERVER['REQUEST_METHOD']);