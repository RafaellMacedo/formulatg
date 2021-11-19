<?php

use Formulatg\Entities\Car;
use Formulatg\Entities\ManagerFactory;

require_once __DIR__ . '/../../vendor/autoload.php';

$managerFactory = new ManagerFactory();
$entityManager = $managerFactory->getManager();

$carRepository = $entityManager->getRepository(Car::class);

$nameDriver = $argv[1];

$pilot = $carRepository->findOneBy([
    'name_driver' => $nameDriver
]);

if(!$pilot){
    echo "Piloto {$nameDriver} não encontrado!\n";
    return;
}

$car = $entityManager->getReference(Car::class, $pilot->getId());

$entityManager->remove($car);
$entityManager->flush();
