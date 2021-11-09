<?php

namespace Formulatg\Repositories;

use Doctrine\ORM\EntityRepository;
use Formulatg\Entities\Car;
use Formulatg\Entities\ManagerFactory;
use Formulatg\Entities\Racing;
use Formulatg\Util\Message;

class RacingCarRepository {

    protected EntityRepository $racingCarRepository;

    /** Message $message */
    private $message;

    public function __construct() {
        $managerFactory = new ManagerFactory();
        $this->entityManager = $managerFactory->getManager();
        $this->racingCarRepository = $this->entityManager->getRepository(Racing::class);
        $this->message = new Message();
    }

    /**
     * @return array
     */
    public function findAll(): array {
        return $this->racingCarRepository->findAll();
    }

    public function findCar($carName): Car {
        /** @var EntityRepository $carRepository */
        $carRepository = $this->entityManager->getRepository(Car::class);
        return $carRepository->findOneBy([ 'name_driver' => $carName ]);
    }

    public function findRacing($racingName): Racing {
        /** @var EntityRepository $racingRepository */
        $racingRepository = $this->entityManager->getRepository(Racing::class);
        return $racingRepository->findOneBy([ 'name' => $racingName ]);
    }

    public function addRacingCar(String $racingName, String $carName): void {
        $racing = $this->findRacing($racingName);
        $car = $this->findCar($carName);
        $car->setPosition(0);
        $racing->addCar($car);

        $this->entityManager->flush();
    }

    public function showPilots(String $racingName): void {
        if(empty($racingName)){
            echo $this->message->infoRacingName();
            exit;
        }

        $racing = $this->findRacing($racingName);

        if($racing) {
            echo "\nId: {$racing->getId()}\n" .
                "Nome: {$racing->getName()}\n" .
                "Status: {$racing->isStatus()}\n\n";

            $cars = $racing->getRacingCar();

            foreach ($cars AS $car) {
                echo "\tId: {$car->getId()}\n" .
                    "\tPiloto: {$car->getNameDriver()}\n" .
                    "\tCor: {$car->getColor()}\n" .
                    "\tNúmero: {$car->getNumber()}\n" .
                    "\tPosição: {$car->getPosition()}\n" .
                    "\n\n";
            }
        }
    }

    public function deleteCar(String $racingName, String $carName) {
        $racing = $this->findRacing($racingName);
        $car = $this->findCar($carName);

        $racing->deleteCar($car);

        $this->entityManager->persist($racing);
        $this->entityManager->flush();
    }

}