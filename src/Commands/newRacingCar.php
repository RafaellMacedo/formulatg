<?php

use Formulatg\Entities\Car;
use Formulatg\Entities\ManagerFactory;
use Formulatg\Entities\Racing;
use Formulatg\Entities\RacingCar;

require_once __DIR__ . '/../../vendor/autoload.php';

$managerFactory = new ManagerFactory();
$entityManager = $managerFactory->getManager();

$racing = $entityManager->find(Racing::class, 1);
$car = $entityManager->find(Car::class, 2);

$listCar = $racing->getRacingCar();

/** $car Car */
foreach ($listCar AS $car) {
    echo $car->getNameDriver();
}

//$racing->addCar($car);

$entityManager->flush();

