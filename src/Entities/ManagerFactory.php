<?php

namespace Formulatg\Entities;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;

class ManagerFactory {

    /**
     * @return EntityManagerInterface
     * @throws \Doctrine\ORM\ORMException
     * */
    public function getManager(): EntityManagerInterface {
        $rootDir = __DIR__.'/../..';
        $config = Setup::createAnnotationMetadataConfiguration(
            [$rootDir.'/src/Entities'],
            true
        );

        $connection = [
            'driver' => 'pdo_sqlite',
            'path' => $rootDir.'/var/data/banco.sqlite'
        ];

        return EntityManager::create($connection, $config);
    }
}