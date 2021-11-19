<?php

use Formulatg\Entities\ManagerFactory;

require_once __DIR__.'/vendor/autoload.php';

$managerFactory = new ManagerFactory();

$entityManager = $managerFactory->getManager();

var_dump($entityManager->getConnection());