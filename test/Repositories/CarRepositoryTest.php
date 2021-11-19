<?php

namespace Formulatg\Test\Controllers;

use Formulatg\Entities\Car;
use Formulatg\Entities\ManagerFactory;
use Formulatg\Repositories\CarRepository;
use Formulatg\Util\Message;
use PHPStan\Testing\TestCase;

class CarRepositoryTest extends TestCase {

    /**
     * @var CarRepository
    */
    private $carRepository;

    private $entityManager;

    /**
     * @var Message
    */
    private $message;

    protected function setUp(): void {
        $managerFactory = $this->createMock(ManagerFactory::class);
        $this->entityManager = $managerFactory->getManager();
        $this->carRepository = $this->createMock(CarRepository::class);
        $this->message = new Message();
    }

    public function testRepository_ShouldCreateCarExpectedSuccess(): void {
        $car = $this->carStore();

        $this->carRepository->method('create')
            ->willReturn([
                "success" => true,
                "message" => $this->message->pilotRegisteredSuccess()
            ]);

        $resultCar = $this->carRepository->create($car);

        $this->assertTrue($resultCar["success"]);
    }

    public function testRepository_ShouldCreateCarExistExpectedFail(): void {
        $carfirst = $this->carStore();
        $carSecond = $this->carStore();

        $this->carRepository->method('create')
            ->willReturn([
                "success" => false,
                "message" => $this->message->pilotRegisteredRacing()
            ]);

        $this->carRepository->create($carfirst);

        $resultCarSecond = $this->carRepository->create($carSecond);

        $this->assertFalse($resultCarSecond["success"]);
        $this->assertSame($this->message->pilotRegisteredRacing(), $resultCarSecond['message']);
    }

    public function testRepository_shouldCreateCarExpectedFail(): void {
        $car = $this->carFailStore();

        $this->carRepository->method('create')
            ->willReturn([
                "success" => false,
                "message" => $this->message->emptyNamePilot()
            ]);

        $resultCar = $this->carRepository->create($car);

        $this->assertFalse($resultCar["success"]);
        $this->assertSame($this->message->emptyNamePilot(), $resultCar['message']);
    }

    private function carStore(): Car {
        $car = new Car();
        $car->setNameDriver('Piloto Novo');
        $car->setColor('Azul');
        $car->setNumber(20);
        $car->setPosition(0);
        return $car;
    }

    private function carFailStore(): Car {
        $car = new Car();
        $car->setNameDriver('');
        $car->setColor(1);
        $car->setNumber('020');
        $car->setPosition(0);
        return $car;
    }
}