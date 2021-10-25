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

    public function exist(String $command): bool {
        if(empty($command)){
            $this->message->infoCommand();
            return false;
        }

        return in_array($command, CommandEnum::COMANDS);
    }

    public function listarComando(): void {
        $listCommands = new listCommands();
        $listCommands->listCommands();
    }

    public function cadastrarCarro(): void {
        $controller = new CarController();
        $controller->store($this->fields);
    }

    public function mostrarCarro(): void {
        $controller = new CarController();
        $controller->index();
    }

    public function posicaoCarro(): void {
        if(!isset($this->fields[2])){
            $this->message->emptyPilot();
            exit;
        }

        if(!isset($this->fields[3])){
            $this->message->infoPilotPosition();
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
                    $this->message->infoRacingName();
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
            $this->message->infoRacingName();
            return false;
        }
        return true;
    }
}