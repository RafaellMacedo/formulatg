<?php

use Doctrine\ORM\EntityRepository;
use Formulatg\Entities\Car;
use Formulatg\Entities\ManagerFactory;
use Formulatg\Entities\Racing;
use Formulatg\Entities\RacingCar;

require_once __DIR__ . '/../../vendor/autoload.php';

$managerFactory = new ManagerFactory();
$entityManager = $managerFactory->getManager();

/** @var EntityRepository $racingRepository */
$racingRepository = $entityManager->getRepository(Racing::class);

/** @var EntityRepository $carRepository */
$carRepository = $entityManager->getRepository(Car::class);

//$racing = $entityManager->find(Racing::class, 1);
//$car = $entityManager->find(Car::class, 2);

$racing = $racingRepository->findOneBy([ 'name' => 'Primeira Corrida']);
$car = $carRepository->findOneBy([ 'name_driver' => 'Piloto B']);

print_r($racing); exit;

$racing->deleteCar($car);

$entityManager->persist($racing);
$entityManager->flush();
