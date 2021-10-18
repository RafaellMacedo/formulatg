<?php

namespace Formulatg\Repositories;

use Doctrine\ORM\EntityRepository;
use Formulatg\Entities\Car;
use Formulatg\Entities\ManagerFactory;

class CarRepository {

    protected EntityRepository $carRepository;

    /** @throws Exception */
    public function __construct() {
        $managerFactory = new ManagerFactory();
        $this->entityManager = $managerFactory->getManager();
        $this->carRepository = $this->entityManager->getRepository(Car::class);
    }

    /**
     * @return array
     */
    public function findAll(): array {
        return $this->carRepository->findBy([], ['position' => 'ASC']);
    }

    /**
     * @param Car $car
     * @throws \Exception
     */
    public function create(Car $car): void {
        $this->entityManager->persist($car);
        $this->entityManager->flush();
    }
}