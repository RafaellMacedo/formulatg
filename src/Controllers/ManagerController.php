<?php

namespace Formulatg\Controllers;

use Doctrine\ORM\EntityManagerInterface;
use Formulatg\Entities\ManagerFactory;
use PhpParser\Builder\Class_;

class ManagerController {

    /**
     * @var EntityManagerInterface
    */
    public $entityManager;

    /**
     * @var Repository
     * */
    public $repository;

    public function __construct() {
        $managerFactory = new ManagerFactory();
        $this->entityManager = $managerFactory->getManager();
    }

    public function setRepository($repository){
        $this->repository = $this->entityManager->getRepository(get_class($repository));
    }
}
