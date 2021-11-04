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

    public function existPilotWithoutPosition(): void {
        echo "\nExiste piloto sem posição definida!\n\n";
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

    public function racingPaused(): void {
        echo "\nCorrida pausada!\n\n";
    }

    public function racingCreate(): void {
        echo "\nCorrida criada!\n\n";
    }

    public function racingNotFound(String $racingName): void {
        echo "\nCorrida {$racingName} Não Encontrada\n\n";
    }

    public function racingStart(String $racingName): void {
        echo "\nCorrida {$racingName} Iniciada\n\n";
    }

    public function racingNotCanFinished(): void {
        echo "\nCorrida não pode ser finalizada, se não estiver sido iniciada\n\n";
    }

    public function existRacingStarted(String $racingName): void {
        echo "\nJá existe uma corrida iniciada, finalize $racingName\n\n";
    }

    public function commandNotFound(): void {
        echo "\nComando não encontrado\n\n";
    }

    public function infoCommand(): void {
//        echo "\nDigite o comando listarComando para listar todos os comandos\n\n";
        throw new \DomainException("Digite o comando listarComando para listar todos os comandos");
        exit;
    }

    public function racingFinishedAndNotStart(): void {
        echo "\nCorrida finalizada não pode ser iniciada novamente, cadastre uma nova corrida\n\n";
    }

    public function racingFewPilots(): void {
        echo "\nCorrida só pode ser iniciada com dois ou mais pilotos cadastrados!\n\n";
    }
}