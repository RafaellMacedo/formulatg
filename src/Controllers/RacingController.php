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
            echo $this->message->infoRacingName();
            exit;
        }

        $racing = $this->racingRepository->fromArgvToFields($argv);
        $racingCreate = $this->racingRepository->create($racing);

        echo $racingCreate['message'];
    }

    public function start($nameRacing): void {
        if($nameRacing == ""){
            echo $this->message->infoRacingName();
            exit;
        }

        $resultStartRacing = $this->racingRepository->startRacing($nameRacing);
        echo $resultStartRacing['message'];
    }

    public function pause(String $nameRacing): void {
        if($nameRacing == ""){
            echo $this->message->infoRacingName();
            exit;
        }

        $this->racingRepository->pauseRacing($nameRacing);
    }

    public function finish(String $racingName): void {
        if($racingName == "") {
            echo $this->message->infoRacingName();
            exit;
        }

        $this->racingRepository->finish($racingName);
    }
}
