<?php

use Formulatg\Controllers\CommandController;
use Formulatg\Util\Message;

require_once __DIR__ . '/vendor/autoload.php';

try {
    $command = $argv[1];
    $message = new Message();

    if(empty($command)){
        echo "\nDigite o comando listarComando para listar todos os comandos\n\n";
        exit;
    }

    $commandController = new CommandController($argv);
    $commandController->$command();

} catch (Exception $exception){

}
