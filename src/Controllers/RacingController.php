<?php

namespace Formulatg\Controllers;

use Formulatg\Entities\Racing;
use Formulatg\Repositories\RacingRepository;
use Formulatg\Util\Message;

class RacingController {

    /**
     * @var RacingRepository
     */
    private $repository;

    /**
     * @var Message
    */
    private $message;

    public function __construct() {
        $this->repository = new RacingRepository();
        $this->message = new Message();
    }

    public function mostrar(): void {
        $this->repository->showRacingAll();
    }

    public function criar($argv): void {
        if(count($argv) < 4){
            $this->message->racingNameNotFound();
            exit;
        }

        $racing = $this->repository->fromArgvToFields($argv);
        $this->repository->create($racing);
    }

    public function iniciarCorrida($nameRacing): void {
        if($nameRacing == ""){
            $this->message->racingNameNotFound();
            exit;
        }

        $this->repository->beginRacing($nameRacing);
    }

    public function pausarCorrida($nameRacing): void {
        if($nameRacing == ""){
            $this->message->racingNameNotFound();
            exit;
        }

        $this->repository->pauseRacing($nameRacing);
    }
}
