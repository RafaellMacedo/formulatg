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

    public function infoPilotPosition(): void {
        echo "\nInforme a posição do carro\n\n";
    }

    public function racingEmpty(): void {
        echo "\nNenhuma corrida criada\n\n";
    }

    public function infoRacingName(): void {
        echo "\nInforme o nome da Corrida\n\n";
    }

    public function racingNotStarted(): void {
        echo "\nCorrida não iniciada!\n\n";
    }

    public function commandNotFound(): void {
        echo "\nComando não encontrado\n\n";
    }

    public function infoCommand(): void {
        echo "\nDigite o comando listarComando para listar todos os comandos\n\n";
    }
}