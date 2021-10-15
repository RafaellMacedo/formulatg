<?php

use Formulatg\Entity\ManagerFactory;

require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;

$managerFactory = new ManagerFactory();
$entityManager = $managerFactory->getManager();

return ConsoleRunner::createHelperSet($entityManager);

//try {
//    $entityManager = (new DB())->getConnection();
//    return ConsoleRunner::createHelperSet($entityManager);
//} catch (Exception $exception) {
//    echo 'Erro ao obter conexão com o banco' . PHP_EOL;
//    print_r($exception);
//}