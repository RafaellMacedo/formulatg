<?php

use Formulatg\Controllers\CarController;
use Formulatg\Controllers\RacingController;
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

        case 'corrida':
            $input = $argv[2];

            if($input){
                $controller = new RacingController();
                $controller->$input($argv);
                break;
            }

            echo "\nInforme a ação que deseja fazer: \n\n".
                "mostrar - {Mostra todas as Corrida}\n" .
                "criar - {Criar Corrida}\n" .
                "addCarro - {Cadastrar Carro na Corrida}\n" .
                "removerCarro - {Remover Carro da Corrida}\n" .
                "posicao - {Definir Posição do Carro}\n\n";
            break;
        case 'iniciarCorrida':
            break;
        case 'ultrapassar':
            break;
        case 'finalizarCorrida':
            break;
    }
} catch (Exception $exception){

}

$managerFactory = new ManagerFactory();
$entityManager = $managerFactory->getManager();

