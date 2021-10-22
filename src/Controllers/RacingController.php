<?php

namespace Formulatg\Controllers;

use Formulatg\Entities\Racing;
use Formulatg\Repositories\RacingRepository;
use Formulatg\Util\Message;

class RacingController {

    /**
     * @var RacingRepository
     */
    private $racingRepository;

    /**
     * @var Message
    */
    private $message;

    public function __construct() {
        $this->racingRepository = new RacingRepository();
        $this->message = new Message();
    }

    public function mostrar(): void {
        $this->racingRepository->showRacingAll();
    }

    public function criar($argv): void {
        if(count($argv) < 4){
            $this->message->infoRacingName();
            exit;
        }

        $racing = $this->racingRepository->fromArgvToFields($argv);
        $this->racingRepository->create($racing);
    }

    public function start($nameRacing): void {
        if($nameRacing == ""){
            $this->message->infoRacingName();
            exit;
        }

        $this->racingRepository->startRacing($nameRacing);
    }

    public function pause(String $nameRacing): void {
        if($nameRacing == ""){
            $this->message->infoRacingName();
            exit;
        }

        $this->racingRepository->pauseRacing($nameRacing);
    }

    public function finish(String $racingName): void {
        if($racingName == "") {
            $this->message->infoRacingName();
            exit;
        }

        $this->racingRepository->finish($racingName);
    }
}
