<?php

use Formulatg\Entities\ManagerFactory;

require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;

//try {
    $managerFactory = new ManagerFactory();
    $entityManager = $managerFactory->getManager();

    return ConsoleRunner::createHelperSet($entityManager);
//} cath (Hoa\Exception\Exception::class $exception) {
//    echo 'Error connect in database';
//    print_r($exception);
//}
