<?php

namespace Formulatg\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;

class ManagerFactory {

    /*
     * @return EntityManagerInterface
     * @throws \Doctrine\ORM\ORMException
     * */
    public function getManager(): EntityManagerInterface {
        $rootDir = __DIR__.'/../..';
        $config = Setup::createAnnotationMetadataConfiguration(
            [$rootDir.'/src'],
            true
        );

        $connection = [
            'driver' => 'pdo_mysql',
            'path' => $rootDir.'/var/data/dabase'
        ];

        return EntityManager::create($connection, $config);
    }
}