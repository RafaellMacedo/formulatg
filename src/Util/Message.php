<?php

namespace Formulatg\Util;

class Message {

    public function emptyPilot(): void {
        echo "\nInforme o nome do piloto\n\n";
    }

    public function pilotRegisteredRacing(): void {
        echo "\nPiloto já cadastrado\n\n";
    }

    public function pilotRegisteredSuccess(): void {
        echo "\nPiloto cadastrado!\n\n";
    }

    public function racingEmpty(): void {
        echo "\nNenhuma corrida criada\n\n";
    }

    public function racingNameNotFound(): void {
        echo "\nInforme o nome da Corrida\n\n";
    }
}