<?php

use Formulatg\Entities\Car;
use Formulatg\Entities\ManagerFactory;

require_once __DIR__ . '/../../vendor/autoload.php';

$managerFactory = new ManagerFactory();
$entityManager = $managerFactory->getManager();

$carRepository = $entityManager->getRepository(Car::class);

/** $var Car[] $carList */
$carList = $carRepository->findAll();

foreach ($carList as $key => $car) {
    echo "Piloto: {$car->getNameDriver()}\n\n";
}

