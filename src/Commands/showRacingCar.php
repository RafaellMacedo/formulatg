<?php

use Doctrine\DBAL\Logging\DebugStack;
use Formulatg\Entities\Car;
use Formulatg\Entities\ManagerFactory;
use Formulatg\Entities\Racing;

require_once __DIR__ . '/../../vendor/autoload.php';

$managerFactory = new ManagerFactory();
$entityManager = $managerFactory->getManager();

$racingRepository = $entityManager->getRepository(Racing::class);

$debugStack = new DebugStack();
$entityManager->getConfiguration()->setSQLLogger($debugStack);

/** @var Racing[] $racings */
$racings = $racingRepository->findAll();

foreach($racings AS $racing) {
    $cars = $racing->getCars()
        ->map(function (Car $car) {
            return $car->getNameDriver();
        })->toArray();

    echo "\nId: {$racing->getId()}\n" .
        "Nome: {$racing->getName()}\n" .
        "Carros: " . implode(",", $cars);

    $cars = $racing->getCars();

    foreach ($cars AS $car) {
        echo "\n\n\tId: {$car->getId()}\n" .
            "\tPiloto: {$car->getNameDriver()}\n\n";
    }
}

print_r($debugStack);
