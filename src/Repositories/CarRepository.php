<?php

namespace Formulatg\Repositories;

use Doctrine\ORM\EntityRepository;
use Formulatg\Entities\Car;
use Formulatg\Entities\ManagerFactory;
use InvalidArgumentException;

class CarRepository {

    protected EntityRepository $carRepository;

    public function __construct() {
        $managerFactory = new ManagerFactory();
        $this->entityManager = $managerFactory->getManager();
        $this->carRepository = $this->entityManager->getRepository(Car::class);
    }

    /**
     * @return array
     */
    public function findAll(): array {
        return $this->carRepository->findAll();
    }

    public function findByName(String $nameDriver) {
        return $this->carRepository->findOneBy([
            'name_driver' => $nameDriver
        ]);
    }

    public function existPosition(Int $position) {
        return $this->carRepository->findOneBy([
            'position' => $position
        ]);
    }

    public function showCars(): void {
        $carList = $this->findAll();

        foreach ($carList as $key => $car) {
            echo "\nId: {$car->getId()}\n" .
                "Piloto: {$car->getNameDriver()}\n" .
                "Cor: {$car->getColor()}\n" .
                "Número: {$car->getNumber()}\n" .
                "Status: {$car->getStatus()}\n" .
                "Posição: {$car->getPosition()}\n\n";
        }
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
        $car->setPosition($argv[6] ?? 0);
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

    public function position(String $carName, int $position): void {
        if($this->existPosition($position)){
            echo "\nJá existe piloto cadastrado na posição {$position}\n\n";
            exit;
        }

        $car = $this->findByName($carName);

        $car->setPosition($position);
        $this->entityManager->persist($car);
        $this->entityManager->flush();
    }
}