<?php

namespace Formulatg\Controllers;

use Formulatg\Commands\listCommands;
use Formulatg\Util\CommandEnum;
use Formulatg\Util\Message;

class CommandController {

    private $fields;

    /**
     * @var Message
    */
    private $message;

    public function __construct(Array $fields) {
        $this->fields = $fields;
        $this->message = new Message();
    }

    /** @throws \DomainException */
    public function exist(String $command) {
        if(empty($command)){
            echo $this->message->infoCommand();
        }

        return in_array($command, CommandEnum::COMANDS);
    }

    public function listarComando(): void {
        $listCommands = new listCommands();
        $listCommands->listCommands();
    }

    public function cadastrarCarro(): void {
        $controller = new CarController();

        if(count($this->fields) < 5){
            echo $this->message->pilotInfoEmpty();
            $listCommands = new listCommands();
            $listCommands->commandCreateCar();
            exit;
        }

        $controller->create($this->fields);
    }

    public function mostrarCarro(): void {
        $controller = new CarController();
        $controller->showListCars();
    }

    public function removerCarro(): void {
        $controller = new CarController();
        $controller->removerCar($this->fields[2]);
    }

    public function posicaoCarro(): void {
        if(!isset($this->fields[2])){
            echo $this->message->emptyNamePilot();
            exit;
        }

        if(!isset($this->fields[3])){
            echo $this->message->infoPilotPosition();
            exit;
        }

        $controller = new CarController();
        $controller->position($this->fields);
    }

    public function corrida(): void {
        $input = $this->fields[2];

        if($input) {
            $controller = new RacingController();

            $racingCarInput = [
                'mostrarPilotos',
                'addCarro',
                'removerCarro'
            ];

            if(in_array($input, $racingCarInput)) {
                if(!isset($this->fields[3])){
                    echo $this->message->infoRacingName();
                    exit;
                }
                $controller = new RacingCarController();
            }

            $controller->$input($this->fields);
            exit;
        }

        $listCommands = new listCommands();
        $listCommands->commandRacing();
    }

    public function iniciarCorrida(): void {
        $controller = new RacingController();
        $controller->start($nameRacing = $this->fields[2]);
    }

    public function pausarCorrida(): void {
        $controller = new RacingController();
        $controller->pause($nameRacing = $this->fields[2]);
    }

    public function ultrapassar(): void {
        if($this->informedRacing()){
            $controller = new HistoryRacingController();
            $controller->exceed($this->fields);
        }
    }

    public function finalizarCorrida(): void {
        if($this->informedRacing()){
            $controller = new RacingController();
            $controller->finish($this->fields[2]);
        }
    }

    public function historicoCorrida(): void {
        if($this->informedRacing()){
            $controller = new HistoryRacingController();
            $controller->showHistoric($this->fields[2]);
        }
    }

    public function informedRacing(): bool {
        if(!isset($this->fields[2])){
            echo $this->message->infoRacingName();
            return false;
        }
        return true;
    }
}