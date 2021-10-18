<?php

namespace Formulatg\Controllers;

use Formulatg\Entities\Car;
use Formulatg\Repositories\CarRepository;

class CarController {

    /**
     * @var CarRepository
    */
    private $repository;

    public function __construct() {
        $this->repository = new CarRepository();
    }

    public function index(){
        $carList = $this->repository->findAll();

        foreach ($carList as $key => $car) {
            echo "Piloto: {$car->getNameDriver()}\n\n";
        }
    }

    public function store(Car $car){
        $this->repository->create($car);
    }
}