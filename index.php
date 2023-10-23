<?php
require 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
require(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR . 'MainController.php');

use App\Controller\MainController;



$controller = MainController::getInstance();
$controller->home();
