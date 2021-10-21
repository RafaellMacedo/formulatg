<?php

namespace Formulatg\Controllers;

use Formulatg\Repositories\CarRepository;
use Formulatg\Util\Message;

class CarController {

    /**
     * @var CarRepository
    */
    private $repository;

    /**
     * @var Message
    */
    private $message;

    public function __construct() {
        $this->repository = new CarRepository();
        $this->message = new Message();
    }

    public function index(): void {
        $this->repository->showCars();
    }

    public function store($argv): void {
        $car = $this->repository->fromArgvToFields($argv);

        if($this->repository->isExist($car)){
            $this->message->pilotRegisteredRacing();
            exit;
        }

        $this->repository->create($car);
        $this->message->pilotRegisteredSuccess();
    }
}
