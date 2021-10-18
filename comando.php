<?php

use Formulatg\Controllers\CarController;
use Formulatg\Entities\ManagerFactory;

require_once __DIR__ . '/vendor/autoload.php';

try {
    $command = $argv[1];

    switch ($command){
        case 'cadastrarCarro': $controller = new CarController();
            
            $controller->store();
            break;

        case 'mostrarCarro': $controller = new CarController();
                $controller->index();
            break;
    }
} catch (Exception $exception){

}

$managerFactory = new ManagerFactory();
$entityManager = $managerFactory->getManager();

