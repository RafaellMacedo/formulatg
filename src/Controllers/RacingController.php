<?php

namespace Formulatg\Controllers;

use Formulatg\Entities\Racing;
use Formulatg\Repositories\RacingRepository;

class RacingController {

    /**
     * @var RacingRepository
     */
    private $repository;

    public function __construct() {
        $this->repository = new RacingRepository();
    }

    public function mostrar(){
        $racingList = $this->repository->findAll();

        if(!$racingList) {
            echo "\nNenhuma corrida criada\n\n";
        }

        foreach ($racingList as $key => $racing) {
            echo "\nId: {$racing->getId()}\n" .
                "Corrida: {$racing->getName()}\n".
                "Status: {$racing->isStatus()}\n\n";
        }
    }

    public function criar($argv){
        if(count($argv) < 4){
            echo "\nInforme o nome da Corrida\n\n";
            return;
        }

        $racing = $this->repository->fromArgvToFields($argv);
        $this->repository->create($racing);

        echo "\nCorrida criada!\n\n";
    }

    public function iniciarCorrida($nameRacing){
        if($nameRacing == ""){
            echo "\nInforme o nome da corrida\n\n";
            return false;
        }
        echo $this->repository->beginRacing($nameRacing);
    }


    public function pausarCorrida($nameRacing){
        if($nameRacing == ""){
            echo "\nInforme o nome da corrida\n\n";
            return false;
        }
        echo $this->repository->pauseRacing($nameRacing);
    }

    public function command(): string {
        return "\n> corrida <comando>\n\n" .
                "\t**Lista de comandos da Corrida**\n\n".
                "\tmostrar - {Mostra todas as Corrida}\n" .
                "\tcriar - {Criar Corrida}\n" .
                "\taddCarro - {Cadastrar Carro na Corrida}\n" .
                "\tremoverCarro - {Remover Carro da Corrida}\n" .
                "\tposicao - {Definir Posição do Carro}\n\n" .
                "\t***\n\n" .
            "> iniciarCorrida \n" .
            "\n" .
            "> pausarCorrida \n" .
            "\n" .
            "> ultrapassar\n" .
            "\n" .
            "> finalizarCorrida\n\n";
    }
}
