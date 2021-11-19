<?php

namespace Repositories;

use Formulatg\Entities\Car;
use Formulatg\Entities\ManagerFactory;
use Formulatg\Entities\Racing;
use Formulatg\Repositories\CarRepository;
use Formulatg\Repositories\RacingCarRepository;
use Formulatg\Repositories\RacingRepository;
use Formulatg\Util\Message;
use PHPUnit\Framework\TestCase;

class RacingRepositoryTest extends TestCase {

    /** @var RacingRepository */
    private $racingRepository;

    /** @var RacingCarRepository */
    private $racingCarRepository;

    /** @var CarRepository */
    private $carRepository;

    private $entityManager;

    /** @var Message */
    private $message;

    protected function setUp(): void {
        $managerFactory = $this->createMock(ManagerFactory::class);
        $this->entityManager = $managerFactory->getManager();
        $this->carRepository = $this->createMock(CarRepository::class);
        $this->racingRepository = $this->createMock(RacingRepository::class);
        $this->racingCarRepository = $this->createMock(RacingCarRepository::class);
        $this->message = new Message();
    }

    public function testRepository_ShouldCreateNewRacing_ExpectedSuccessed(): void {
        $racing = $this->racingStore();

        $this->racingRepository->method('create')
            ->willReturn([
                "success" => true,
                "message" => $this->message->racingCreate()
            ]);

        $resultRacing = $this->racingRepository->create($racing);

        $this->assertTrue($resultRacing["success"]);
        $this->assertSame($this->message->racingCreate(), $resultRacing["message"]);
    }

    public function testRepository_ShouldCreateNewRacingWithNameEmpty_ExpectedFail(): void {
        $racing = $this->racingStore();
        $racing->setName('');

        $this->racingRepository->method('create')
            ->willReturn([
                "success" => false,
                "message" => $this->message->emptyRacingName()
            ]);

        $resultRacing = $this->racingRepository->create($racing);

        $this->assertFalse($resultRacing["success"]);
        $this->assertSame($this->message->emptyRacingName(), $resultRacing["message"]);
    }

    public function testRepository_ShouldStartRacing_ExpectedSuccess(): void {
        $racing = $this->racingStore();
        $carFirst = $this->carStore('Rafael', 'Black', 20, 1);
        $carSecond = $this->carStore('José', 'Blue', 15, 2);
        $carThird = $this->carStore('Aline', 'Red', 25, 3);

        $this->mockCar($carFirst);
        $this->mockCar($carSecond);
        $this->mockCar($carThird);

        $this->mockRacing($racing);

        $this->mockRacingCar($racing, $carFirst);
        $this->mockRacingCar($racing, $carSecond);
        $this->mockRacingCar($racing, $carThird);

        $this->racingRepository->method('startRacing')
            ->willReturn([
                "success" => true,
                "message" => $this->message->racingStart($racing->getName())
            ]);

        $resultRacing = $this->racingRepository->startRacing($racing->getName());

        $this->assertTrue($resultRacing["success"]);
        $this->assertSame($this->message->racingStart($racing->getName()), $resultRacing["message"]);
    }

    public function testRepository_ShouldStartDoubleRacing_ExpectedNotStarting(): void {
        $racing = $this->racingStore();
        $racing2 = $this->racingStore2();

        $this->mockRacingWithCar($racing);
        $this->mockRacingWithCar($racing2);

        $this->racingRepository->method('startRacing')
            ->willReturn([
                "success" => false,
                "message" => $this->message->existRacingStarted($racing2->getName())
            ]);

        $this->racingRepository->startRacing($racing->getName());

        $resultRacing = $this->racingRepository->startRacing($racing2->getName());

        $this->assertFalse($resultRacing["success"]);
        $this->assertSame($this->message->existRacingStarted($racing2->getName()), $resultRacing["message"]);
    }

    public function testRepository_ShouldNotStartRacingFinished_ExpectedMessagerError(): void {
        $racing = $this->racingStore();
        $this->mockRacingWithCar($racing);

        $this->racingRepository->method('startRacing')
            ->willReturn([
                "success" => false,
                "message" => $this->message->racingFinishedAndNotStart()
            ]);

        $resultRacing = $this->racingRepository->startRacing($racing->getName());


        $this->assertFalse($resultRacing["success"]);
        $this->assertSame($this->message->racingFinishedAndNotStart(), $resultRacing["message"]);
    }

    public function testRepository_ShouldNotStartRacing_ExpectedFewPilots(): void {
        $racing = $this->racingStore();

        $carFirst = $this->carStore('Rafael', 'Black', 20, 1);

        $this->mockCar($carFirst);
        $this->mockRacing($racing);
        $this->mockRacingCar($racing, $carFirst);

        $this->racingRepository->method('startRacing')
            ->willReturn([
                "success" => false,
                "message" => $this->message->racingFewPilots()
            ]);

        $resultRacing = $this->racingRepository->startRacing($racing->getName());


        $this->assertFalse($resultRacing["success"]);
        $this->assertSame($this->message->racingFewPilots(), $resultRacing["message"]);
    }

    public function testRespository(): void {
        $carFirst = $this->carStore('Rafael', 'Black', 20, 1);
        $this->mockCar($carFirst);
    }

    public function racingStore(): Racing {
        $racing = new Racing();
        $racing->setName('Corrida Maluca');
        $racing->setStatus(1);
        return $racing;
    }

    public function racingStore2(): Racing {
        $racing = new Racing();
        $racing->setName('Formula 1');
        $racing->setStatus(1);
        return $racing;
    }

    private function carStore($nameDriver, $color, $number, $position): Car {
        $car = new Car();
        $car->setNameDriver($nameDriver);
        $car->setColor($color);
        $car->setNumber($number);
        $car->setPosition($position);
        return $car;
    }

    public function mockCar(Car $car): void {
        $this->carRepository->create($car);
    }

    public function mockRacing(Racing $racing): void {
        $this->racingRepository->create($racing);
    }

    public function mockRacingCar(Racing $racing, Car $car): void{
        $this->racingCarRepository->addRacingCar($racing->getName(), $car->getNameDriver());
    }

    public function mockRacingWithCar(Racing $racing): void {
        $carFirst = $this->carStore('Rafael', 'Black', 20, 1);
        $carSecond = $this->carStore('José', 'Blue', 15, 2);
        $carThird = $this->carStore('Aline', 'Red', 25, 3);

        $this->mockCar($carFirst);
        $this->mockCar($carSecond);
        $this->mockCar($carThird);

        $this->mockRacing($racing);

        $this->mockRacingCar($racing, $carFirst);
        $this->mockRacingCar($racing, $carSecond);
        $this->mockRacingCar($racing, $carThird);
    }
}
