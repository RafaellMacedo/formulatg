<?php

namespace Formulatg\Commands;

class listCommands {

    public function listCommands(): void {
        $this->head();
        $this->commandCreateCar();
        $this->commandCarAction();
        $this->commandRacing();
        $this->commandActionRacing();
    }

    public function head(): void {
        echo "\nLISTA DE COMANDOS\n";
    }

    public function commandCreateCar(): void {
        echo "\n> cadastrarCarro <nome_piloto> <cor> <numero> <status OPCIONAL>\n\n" .
            "\t**Lista de informações**\n\n" .
            "\tnome do piloto usando aspas duplas \"\"\n" .
            "\tcor do carro\n" .
            "\tnúmero\n" .
            "\tStatus do Carro Ativo ou Inativo (Opcional)\n\n" .
            "\t***\n\n";
    }

    public function commandCarAction(): void {
        echo "\n> mostrarCarro\n" .
            "\n> removerCarro\n" .
            "\n> posicaoCarro\n" .
            "\n\t**Passe as seguintes informações**\n\n" .
            "\tnome da corrida usando aspas duplas \"\"\n" .
            "\tnome do piloto usando aspas duplas \"\"\n" .
            "\tposição\n\n" .
            "\t***\n\n";
    }

    public function commandRacing(): void {
        echo "\n> corrida <comando>\n\n" .
            "\t**Lista de comandos da Corrida**\n\n" .
            "\tmostrar - {Mostra todas as Corrida}\n" .
            "\tmostrarPilotos <nome da corrida \"\"> {Mostra todas os pilotos da corrida}\n" .
            "\tcriar - {Criar Corrida}\n" .
            "\taddCarro - {Cadastrar Carro na Corrida}\n" .
            "\tremoverCarro - {Remover Carro da Corrida}\n" .
            "\tposicao - {Definir Posição do Carro}\n\n" .
            "\t***\n\n";
    }

    public function commandActionRacing(): void {
            echo "> iniciarCorrida \n\n" .
            "> pausarCorrida \n\n" .
            "> ultrapassar\n\n" .
            "> finalizarCorrida\n\n" .
            "> historicoCorrida\n\n";
    }
}
