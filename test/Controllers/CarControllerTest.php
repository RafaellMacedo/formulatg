<?php

namespace Formulatg\Test\Controllers;

use Formulatg\Controllers\CarController;
use Formulatg\Entities\Car;
use PHPStan\Testing\TestCase;

class CarControllerTest extends TestCase {

    public function testController_ShouldCreateCarExpectedSuccess(): void {
        $car = [
            2 => 'Piloto A',
            3 => 10,
            4 => 'Black',
            5 => 1
        ];

        $carController = new CarController();
        $message = $carController->store($car);
        echo $message;
//        $this->assertEquals();
    }
}