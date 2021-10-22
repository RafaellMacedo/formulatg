<?php

namespace Formulatg\Controllers;

use Formulatg\Repositories\HistoryRacingRepository;

class HistoryRacingController {

    /**
     * @var HistoryRacingRepository
    */
    private HistoryRacingRepository $historyRacingRepository;

    public function __construct() {
        $this->historyRacingRepository = new HistoryRacingRepository();
    }

    public function ultrapassar(Array $fields): void {
        $racingName = $fields[2];

        if(count($fields) < 5) {
            echo "\nInforme os nomes dos pilotos\n\n";
            exit;
        }

        $this->historyRacingRepository->createHistory($racingName, $fields[3], $fields[4]);
    }
}