### Bem vindo ao meu projeto chamado de FormulaTG, faça um café e clone este projeto na sua máquina.

Este é um projeto chamado Formula TG com o foco de atender os estudos de phpunit e docker.

Para desenvolver este proejto, utilizei uma atividade conhecida por alguns devs, que é chamado de Formula TG, para saber mais clie no link

https://github.com/RafaellMacedo/formulatg/blob/master/formulatg.pdf

Para iniciar o projeto será necessário ter instalado o docker na máquina.

Se ainda não tem docker instalado, só clicar ai do lado, no icone que você será direcionado para o site de instalação do docker

<a href="https://docs.docker.com/engine/install/ubuntu/" target="_blank"><img src="https://img.icons8.com/color/48/000000/docker.png"/></a>

Beleza, instalado o docker e clonado o repositório, agora é hora de criar os containers, rode o comando para iniciar os containers do projeto.

<pre>docker-compose up -d</pre>

Pronto, agora você tem os containers iniciados, caso queira confirmar se esta online o container, rode o comando

<pre>docker ps</pre>

Agora vamos acessar o container, para acessa-lo rode o comando

<pre>docker exec -it formulatg_php_1 bash</pre>

Dentro do container, vamos rodar o comando de criação do banco de dados que foi implementado usando o doctrine.

<pre>vendor/bin/doctrine orm:schema-tool:create</pre>

Para saber se esta tudo certo, sem nenhum erro com as Entities que foi desenvolvido neste projeto, só rodar o comando do doctrine.

<pre>vendor/bin/doctrine orm:info</pre>

###Pronto, agora o projeto esta configurado em sua máquina para você executar os comandos.

O arquivo comando.php que esta localizado na raiz do projeto, é o responsável por fazer a leitura que você esta digitando em seu terminal, identificar qual comando deseja executar.

### Obs.: Para rodar os comandos do projeto, você precisará estar dentro do container formulatg_php_1

Para listar todos os comandos disponíveis no projeto, informe no terminal o comando abaixo

<pre>php comando.php listarComando</pre>

Irá aparecer a seguinte lista de comando

<pre>
LISTA DE COMANDOS

> cadastrarCarro <nome_piloto> <cor> <numero> <status OPCIONAL>

	**Lista de informações**

	nome do piloto usando aspas duplas ""
	cor do carro
	número
	Status do Carro Ativo ou Inativo (Opcional)

	***


> mostrarCarro

> removerCarro

> posicaoCarro

	**Passe as seguintes informações**

	nome da corrida usando aspas duplas ""
	nome do piloto usando aspas duplas ""
	posição

	***


> corrida <comando>

	**Lista de comandos da Corrida**

	mostrar - {Mostra todas as Corrida}
	mostrarPilotos <nome da corrida ""> {Mostra todas os pilotos da corrida}
	criar - {Criar Corrida}
	addCarro - {Cadastrar Carro na Corrida}
	removerCarro - {Remover Carro da Corrida}
	posicao - {Definir Posição do Carro}

	***

> iniciarCorrida 

> pausarCorrida 

> ultrapassar

> finalizarCorrida

> historicoCorrida

</pre>
