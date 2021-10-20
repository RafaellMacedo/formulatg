<?php

use Formulatg\Commands\listCommands;
use Formulatg\Controllers\CarController;
use Formulatg\Controllers\RacingController;
use Formulatg\Entities\ManagerFactory;

require_once __DIR__ . '/vendor/autoload.php';

try {
    $command = $argv[1];

    switch ($command){
        case 'listarComando':
                $listCommands = new listCommands();
                echo $listCommands->listCommands();
            break;
        case 'cadastrarCarro': $controller = new CarController();
            $controller->store($argv);
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
            $controller = new RacingController();
            $controller->iniciarCorrida($nameRacing = $argv[2]);
            break;

        case 'pausarCorrida':
            $controller = new RacingController();
            $controller->pausarCorrida($nameRacing = $argv[2]);
            break;

        case 'ultrapassar':
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

