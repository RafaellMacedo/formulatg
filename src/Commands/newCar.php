<?php

use Formulatg\Entities\Car;
use Formulatg\Entities\ManagerFactory;

require_once __DIR__ . '/../../vendor/autoload.php';

$car = new Car();
$car->setNameDriver($argv[1]);
$car->setColor($argv[2]);
$car->setNumber($argv[3]);
$car->setStatus($argv[4]);

$managerFactory = new ManagerFactory();
$entityManager = $managerFactory->getManager();

$entityManager->persist($car);

$entityManager->flush();
