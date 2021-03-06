<?php

namespace Formulatg\Repositories;

use Doctrine\ORM\EntityRepository;
use Formulatg\Entities\Car;
use Formulatg\Entities\ManagerFactory;
use Formulatg\Entities\Racing;
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

    private function findAll(): array {
        return $this->carRepository->findAll();
    }

    private function findByName(String $nameDriver): Car {
        return $this->carRepository->findOneBy([
            'name_driver' => $nameDriver
        ]);
    }

    private function findById(String $carId): Car {
        return $this->entityManager->getReference(Car::class, $carId);
    }

    private function existPosition(Int $position) {
        return $this->carRepository->findOneBy([
            'position' => $position
        ]);
    }

    private function getRacing(String $nameRacing): Racing {
        $racingRepository = new RacingRepository();

        return $racingRepository->findByName($nameRacing);
    }

    private function isExist(Car $car): bool {
        $searchNameDriver = [
            'name_driver' => $car->getNameDriver()
        ];

        if($this->carRepository->findOneBy($searchNameDriver)) {
            return true;
        }
        return false;
    }

    private function pilotParticipationRacing(Car $car): bool {
        if($car->existParticipationRacing()){
            return true;
        }

        return false;
    }

    public function showCars(): void {
        $carList = $this->findAll();

        foreach ($carList as $key => $car) {
            echo "\nId: {$car->getId()}\n" .
                "Piloto: {$car->getNameDriver()}\n" .
                "Cor: {$car->getColor()}\n" .
                "N??mero: {$car->getNumber()}\n" .
                "Status: {$car->getStatus()}\n" .
                "Posi????o: {$car->getPosition()}\n\n";
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

            if(!$car->isValid()){
                return [
                    "success" => false,
                    "message" => $this->message->pilotInfoEmpty()
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

    public function position(String $racingName, String $carName, int $position): array {
        $racing = $this->getRacing($racingName);

        if($racing->isStarted()){
            return [
                "success" => false,
                "message" => $this->message->pilotNotChangePositionWithRacingStarted()
            ];
        }

        if($position == 0) {
            return [
                "success" => false,
                "message" => $this->message->positionInvalid($position)
            ];
        }

        if($position > $racing->countCars()){
            return [
                "success" => false,
                "message" => $this->message->positionMoreThanCountCarsInRacing($racing->countCars())
            ];
        }

        if($racing->existPosition($position)){
            return [
                "success" => false,
                "message" => $this->message->pilotExistPositionAnother($position)
            ];
        }


        if($position)

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