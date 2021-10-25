<?php

use Formulatg\Controllers\CommandController;
use Formulatg\Util\Message;

require_once __DIR__ . '/vendor/autoload.php';

try {
    $command = $argv[1];
    $message = new Message();

    if(empty($command)){
        $message->infoCommand();
        exit;
    }

    $commandController = new CommandController($argv);

    if($commandController->exist($command)) {
        $commandController->$command();
        exit;
    }

    $message->commandNotFound();
    $message->infoCommand();

} catch (Exception $exception){

}
