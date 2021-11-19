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

    public function showListCars(): void {
        $this->carRepository->showCars();
    }

    public function create($car): void {
        if(is_array($car)){
            $car = $this->carRepository->fromArgvToFields($car);
        }

        $resultCar = $this->carRepository->create($car);
        echo $resultCar["message"];
    }

    public function removerCar($carName): void{
        if(empty($carName)){
            echo $this->message->emptyNamePilot();
            exit;
        }

        $resultCar = $this->carRepository->delete($carName);
        echo $resultCar["message"];
    }

    public function position(String $racingName, String $nameDriver, $position): void {
        $resultPosition = $this->carRepository->position($racingName, $nameDriver, $position);
        echo $resultPosition['message'];
    }
}
