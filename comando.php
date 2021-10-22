<?php

use Formulatg\Commands\listCommands;
use Formulatg\Controllers\CarController;
use Formulatg\Controllers\HistoryRacingController;
use Formulatg\Controllers\RacingCarController;
use Formulatg\Controllers\RacingController;
use Formulatg\Entities\ManagerFactory;

require_once __DIR__ . '/vendor/autoload.php';

try {
    $command = $argv[1];

    switch ($command){
        case 'listarComando':
                $listCommands = new listCommands();
                $listCommands->listCommands();
            break;
        case 'cadastrarCarro': $controller = new CarController();
            $controller->store($argv);
            break;

        case 'mostrarCarro': $controller = new CarController();
                $controller->index();
            break;

        case 'posicaoCarro':
            if(!isset($argv[2])){
                echo "\nInforme o nome do piloto\n\n";
                break;
            }

            if(!isset($argv[3])){
                echo "\nInforme a posição do carro\n\n";
                break;
            }

            $controller = new CarController();
            $controller->position($argv);
            break;

        case 'corrida':
            $input = $argv[2];

            if($input) {
                $controller = new RacingController();

                $racingCarInput = [
                    'mostrarPilotos',
                    'addCarro',
                    'removerCarro'
                ];

                if(in_array($input, $racingCarInput)) {
                    if(!isset($argv[3])){
                        echo "\nInforme o nome da corrida\n\n";
                        break;
                    }

                    $controller = new RacingCarController();
                }

                $controller->$input($argv);
                break;
            }

            $listCommands = new listCommands();
            $listCommands->commandRacing();

            break;

        case 'iniciarCorrida':
            $controller = new RacingController();
            $controller->iniciarCorrida($nameRacing = $argv[2]);
            break;

        case 'pausarCorrida':
            $controller = new RacingController();
            $controller->pausarCorrida($nameRacing = $argv[2]);
            break;

        case 'ultrapassar':
            if(!isset($argv[2])){
                echo "\nInforme o nome da corrida\n\n";
                break;
            }

            $controller = new HistoryRacingController();
            $controller->ultrapassar($argv);
            break;

        case 'finalizarCorrida':
            break;

        default:
            echo "\nDigite o comando listarComando para listar todos os comandos\n\n";
            break;
    }
} catch (Exception $exception){

}

$managerFactory = new ManagerFactory();
$entityManager = $managerFactory->getManager();

