<?php

namespace Formulatg\Commands;

use Formulatg\Controllers\CarController;
use Formulatg\Controllers\RacingController;

class listCommands {

    public function listCommands(){
        $this->head();
        $this->commandCar();
        $this->commandRacing();
    }

    public function head(): void {
        echo "\nLISTA DE COMANDOS\n";
    }

    public function commandCar(): void{
        $carController = new CarController();
        echo $carController->command();
    }

    public function commandRacing(): void {
        $racingController = new RacingController();
        echo $racingController->command();
    }
}