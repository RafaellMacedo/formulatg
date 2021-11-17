<?php

use Formulatg\Controllers\CommandController;
use Formulatg\Util\Message;

require_once __DIR__ . '/vendor/autoload.php';

$command = $argv[1];
$message = new Message();

if(empty($command)){
    echo $message->infoCommand();
    exit;
}

$commandController = new CommandController($argv);

if($commandController->exist($command)) {
    $commandController->$command();
    exit;
}

echo $message->commandNotFound();
echo $message->infoCommand();
