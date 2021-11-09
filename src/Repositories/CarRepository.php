<?php

namespace Formulatg\Repositories;

use Doctrine\ORM\EntityRepository;
use Formulatg\Entities\Car;
use Formulatg\Entities\ManagerFactory;
use Formulatg\Util\Message;
use InvalidArgumentException;
use PHPUnit\Exception;

class CarRepository {

    protected EntityRepository $carRepository;

    /**
     * @var Message
    */
    private $message;

    public function __construct() {
        $managerFactory = new ManagerFactory();
        $this->entityManager = $managerFactory->getManager();
        $this->carRepository = $this->entityManager->getRepository(Car::class);
        $this->message = new Message();
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

    public function findById(String $carId) {
        return $this->entityManager->getReference(Car::class, $carId);
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
        $car->setNameDriver(isset($argv[2]) ? $argv[2] : '');
        $car->setColor(isset($argv[3]) ? $argv[3] : '');
        $car->setNumber(isset($argv[4]) ? $argv[4] : 0);
        $car->setStatus($argv[5] == "Ativo" ? 1 : 0);
        $car->setPosition($argv[6] ? $argv[6] : 0);
        return $car;
    }

    /**
     * @param Car $car
     * @throws \Exception
     */
    public function create(Car $car): array {
        try {
            if(empty($car->getNameDriver())){
                return [
                    "success" => false,
                    "message" => $this->message->emptyNamePilot()
                ];
            }

            if($this->isExist($car)){
                return [
                    "success" => false,
                    "message" => $this->message->pilotRegisteredRacing()
                ];
            }

            $this->entityManager->persist($car);
            $this->entityManager->flush();

            return [
                "success" => true,
                "message" => $this->message->pilotRegisteredSuccess()
            ];
        } catch(\Exception $exception) {
            throw new \DomainException($exception->getMessage());
        }
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

    public function pilotParticipationRacing(Car $car): bool {
        if($car->existParticipationRacing()){
            return true;
        }

        return false;
    }

    public function delete($carName): array {
        $car = $this->findByName($carName);

        if(!$car){
            return [
                "success" => false,
                "message" => $this->message->pilotNotFound()
            ];
        }

        if($this->pilotParticipationRacing($car)){
            return [
                "success" => false,
                "message" =>$this->message->pilotNotDeleteRacing()
            ];
        }

        $car = $this->findByName($carName);

        $this->entityManager->remove($car);
        $this->entityManager->flush();

        return [
            "success" => true,
            "message" => $this->message->pilotDeltedSuccess()
        ];
    }

    public function position(String $carName, int $position): array {
        if($this->existPosition($position)){
            echo "\nJá existe piloto cadastrado na posição {$position}\n\n";
        }

        $car = $this->findByName($carName);

        $car->setPosition($position);
        $this->entityManager->persist($car);
        $this->entityManager->flush();

        return [
            "success" => true,
            "message" => $this->message->pilotPositionSuccessed()
        ];
    }
}