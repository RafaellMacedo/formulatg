<?php

namespace Formulatg\Controllers;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
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
            echo "\nId: {$car->getId()}\n" .
                "Piloto: {$car->getNameDriver()}\n" .
                "Cor: {$car->getColor()}\n" .
                "Número: {$car->getNumber()}\n" .
                "Status: {$car->getStatus()}\n" .
                "Posição: {$car->getPosition()}\n\n";
        }
    }

    public function store($argv){
        $car = $this->repository->fromArgvToFields($argv);

        if($this->repository->isExist($car)){
            echo "\nPiloto já cadastrado\n\n";
            return;
        }

        $this->repository->create($car);
        echo "\nPiloto cadastrado!\n\n";

    }

    public function command(): string {
        return "\n> cadastrarCarro <nome_piloto> <cor> <numero> <status OPCIONAL>\n\n" .
            "\t**Lista de informações**\n\n" .
            "\tnome do piloto usando aspas duplas \"\"\n" .
            "\tcor do carro\n" .
            "\tnúmero\n" .
            "\tStatus do Carro Ativo ou Inativo (Opcional)\n\n" .
            "\t***\n\n";
    }
}
