<?php

namespace Formulatg\Repositories;

use Doctrine\ORM\EntityRepository;
use Formulatg\Entities\Car;
use Formulatg\Entities\ManagerFactory;
use InvalidArgumentException;

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
     * @return Car
     */
    public function fromArgvToFields($argv): Car {
        $car = new Car();
        $car->setNameDriver($argv[2]);
        $car->setColor($argv[3]);
        $car->setNumber($argv[4]);
        $car->setStatus($argv[5] == "Ativo" ? 1 : 0);
        return $car;
    }

    /**
     * @param Car $car
     * @throws \Exception
     */
    public function create(Car $car): void {
        $this->entityManager->persist($car);
        $this->entityManager->flush();
    }

    public function isExist(Car $car): bool {
        $searchNameDriver = [
            'name_driver' => $car->getNameDriver()
        ];

        if($this->carRepository->findOneBy($searchNameDriver)) {
            return true;
        }
        return false;
    }
}