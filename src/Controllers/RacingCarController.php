<?php

namespace Formulatg\Controllers;

use Formulatg\Repositories\RacingCarRepository;
use Formulatg\Util\Message;

class RacingCarController {

    /**
     * @var RacingCarRepository
    */
    private $racingCarRepository;

    /**
     * @var Message
     */
    private $message;

    public function __construct() {
        $this->racingCarRepository = new RacingCarRepository();
        $this->message = new Message();
    }

    public function addCarro(Array $fields): void {
        if(!isset($fields[4])) {
            echo $this->message->emptyNamePilot();
            exit;
        }

        $this->racingCarRepository->addRacingCar($fields[3], $fields[4]);
    }

    public function mostrarPilotos(Array $racingName): void {
        $this->racingCarRepository->showPilots($racingName[3]);
    }

    public function removerCarro(Array $fields): void {
        if(!isset($fields[4])) {
            echo $this->message->emptyNamePilot();
            exit;
        }

        $this->racingCarRepository->deleteCar($fields[3], $fields[4]);
    }

}