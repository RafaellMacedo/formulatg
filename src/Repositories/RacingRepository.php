<?php

namespace Formulatg\Repositories;

use Doctrine\ORM\EntityRepository;
use Formulatg\Entities\ManagerFactory;
use Formulatg\Entities\Racing;

class RacingRepository {

    protected EntityRepository $racingRepository;

    /** @throws Exception */
    public function __construct() {
        $managerFactory = new ManagerFactory();
        $this->entityManager = $managerFactory->getManager();
        $this->racingRepository = $this->entityManager->getRepository(Racing::class);
    }

    /**
     * @return array
     */
    public function findAll(): array {
        return $this->racingRepository->findBy([], ['position' => 'ASC']);
    }

    /**
     * @return Racing
    */
    public function fromArgvToFields($argv): Racing {
        $racing = new Racing();
        $racing->setName($argv[3]);
        return $racing;
    }
}