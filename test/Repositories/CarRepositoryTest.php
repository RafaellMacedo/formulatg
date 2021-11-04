<?php

namespace Formulatg\Test\Controllers;

use Formulatg\Controllers\CarController;
use Formulatg\Entities\Car;
use Formulatg\Repositories\CarRepository;
use PHPStan\Testing\TestCase;

class CarRepositoryTest extends TestCase {

    /**
     * @var CarRepository
    */
    private $carRepository;

    private $carController;

    protected function setUp(): void {
        $this->carController = $this->createMock(CarController::class);
        $this->carRepository = $this->createMock(CarRepository::class);
    }

    public function testRepository_ShouldCreateCarExpectedSuccess(): void {
        $car = $this->carStore();

        $this->carRepository->method('create')
            ->willReturn(true);

        $this->assertTrue($this->carRepository->create($car));
    }

    public function testRepository_shouldCreateCarExpectedFail(): void {
        $car = $this->carStore();

        $this->carRepository->method('create')
            ->willReturn(false);

        $this->assertFalse($this->carRepository->create($car));
    }

    private function carStore(): Car {
        $car = new Car();
        $car->setNameDriver('Piloto Novo');
        $car->setColor('Azul');
        $car->setNumber(20);
        $car->setPosition(0);
        return $car;
    }
}