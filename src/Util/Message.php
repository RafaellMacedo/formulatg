<?php

namespace Formulatg\Util;

class Message {

    public function emptyNamePilot(): string {
        return "\nInforme o nome do piloto\n\n";
    }

    public function pilotRegisteredRacing(): string {
        return "\nPiloto já cadastrado\n\n";
    }

    public function pilotRegisteredSuccess(): string {
        return "\nPiloto cadastrado!\n\n";
    }

    public function pilotNotFound(): string {
        return "\nPiloto não encontrado!\n\n";
    }

    public function pilotNotDeleteRacing(): string {
        return "\nPiloto não pode ser deletado por ter participado de uma corrida!\n\n";
    }

    public function pilotDeltedSuccess(): string {
        return "\nPiloto deletado!\n\n";
    }

    public function pilotPositionSuccessed(): string {
        return "\nPosição cadastrada com Sucesso!\n\n";
    }

    public function infoPilotPosition(): string {
        return "\nInforme a posição do carro\n\n";
    }

    public function existPilotWithoutPosition(): string {
        return "\nExiste piloto sem posição definida!\n\n";
    }

    public function racingEmpty(): string {
        return "\nNenhuma corrida criada\n\n";
    }

    public function infoRacingName(): string {
        return "\nInforme o nome da Corrida\n\n";
    }

    public function racingNotStarted(): string {
        return "\nCorrida não iniciada!\n\n";
    }

    public function racingPaused(): string {
        return "\nCorrida pausada!\n\n";
    }

    public function racingCreate(): string {
        return "\nCorrida criada!\n\n";
    }

    public function racingNotFound(String $racingName): string {
        return "\nCorrida {$racingName} Não Encontrada\n\n";
    }

    public function racingStart(String $racingName): string {
        return "\nCorrida {$racingName} Iniciada\n\n";
    }

    public function racingNotCanFinished(): string {
        return "\nCorrida não pode ser finalizada, se não estiver sido iniciada\n\n";
    }

    public function existRacingStarted(String $racingName): string {
        return "\nJá existe uma corrida iniciada, finalize $racingName\n\n";
    }

    public function commandNotFound(): string {
        return "\nComando não encontrado\n\n";
    }

    public function infoCommand(): string {
        return "\nDigite o comando listarComando para listar todos os comandos\n\n";
    }

    public function racingFinishedAndNotStart(): string {
        return "\nCorrida finalizada não pode ser iniciada novamente, cadastre uma nova corrida\n\n";
    }

    public function racingFewPilots(): string {
        return "\nCorrida só pode ser iniciada com dois ou mais pilotos cadastrados!\n\n";
    }
}