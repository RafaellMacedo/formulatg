<?php

use Formulatg\Entities\Car;
use Formulatg\Entities\ManagerFactory;

require_once __DIR__ . '/../../vendor/autoload.php';

$managerFactory = new ManagerFactory();
$entityManager = $managerFactory->getManager();

$id = $argv[1];
$nameDriver = $argv[2];

$car = $entityManager->find(Car::class, $id);
$car->setNameDriver($nameDriver);

$entityManager->persist($car);
$entityManager->flush();