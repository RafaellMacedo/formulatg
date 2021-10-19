<?php

namespace Formulatg\Controllers;

use Formulatg\Entities\Racing;
use Formulatg\Repositories\RacingRepository;

class RacingController {

    /**
     * @var RacingRepository
     */
    private $repository;

    public function __construct() {
        $this->repository = new RacingRepository();
    }

    public function mostrar(){
        $racingList = $this->repository->findAll();

        foreach ($racingList as $key => $racing) {
            $racing = new Racing($racing);
            echo "Id: {$racing->getId()}\n" .
                "Corrida: {$racing->getName()}\n".
                "Status: {$racing->isStatus()}\n\n";
        }
    }

    public function criar($argv){
        $racing = $this->repository->fromArgvToFields($argv);
        echo $racing->getName()."\n\n";
    }
}
