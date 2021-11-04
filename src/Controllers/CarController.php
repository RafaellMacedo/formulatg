<?php

namespace Formulatg\Controllers;

use Formulatg\Repositories\CarRepository;
use Formulatg\Util\Message;

class CarController {

    /**
     * @var CarRepository
    */
    private $carRepository;

    /**
     * @var Message
    */
    private $message;

    public function __construct() {
        $this->carRepository = new CarRepository();
        $this->message = new Message();
    }

    public function index(): void {
        $this->carRepository->showCars();
    }

    public function store($car): bool {
        if(is_array($car)){
            $car = $this->carRepository->fromArgvToFields($car);
        }

        if($this->carRepository->isExist($car)){
            $this->message->pilotRegisteredRacing();
            return false;
        }

        $this->carRepository->create($car);
        $this->message->pilotRegisteredSuccess();
        return true;
    }

    public function position(Array $fields): void {
        $this->carRepository->position($fields[2], $fields[3]);
    }
}
