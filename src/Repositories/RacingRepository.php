<?php

namespace Formulatg\Repositories;

use Doctrine\ORM\EntityRepository;
use Formulatg\Entities\Car;
use Formulatg\Entities\ManagerFactory;
use Formulatg\Entities\Racing;
use Formulatg\Util\Message;
use Formulatg\Util\RacingEnum;

class RacingRepository {

    protected EntityRepository $racingRepository;

    /**
     * @var Message
    */
    private $message;

    /**
     * @var EntityRepository $racingRepository
     */
    public function __construct() {
        $managerFactory = new ManagerFactory();
        $this->entityManager = $managerFactory->getManager();
        $this->racingRepository = $this->entityManager->getRepository(Racing::class);

        $this->message = new Message();
    }

    /**
     * @return array
     */
    public function findAll(): array {
        return $this->racingRepository->findAll();
    }

    public function findByName(String $name): Racing {
        return $this->racingRepository->findOneBy([
            'name' => $name
        ]);
    }

    public function showRacingAll(): void {
        $racingList = $this->findAll();

        if(!$racingList) {
            $this->message->racingEmpty();
            exit;
        }

        foreach ($racingList as $key => $racing) {
            echo "\nId: {$racing->getId()}\n" .
                "Corrida: {$racing->getName()}\n".
                "Status: {$racing->isStatus()}\n\n";
        }
    }

    public function isInvalid(Racing $racing): bool {
        if($racing->getRacingCar()->count() <= 1) {
            return true;
        }
        return false;
    }

    public function existPilotInvalid(Racing $racing): bool {
        $positionsEmpty = $racing->getRacingCar()
            ->map(function(Car $car) {
               if($car->getPosition() === 0) {
                   return 'empty';
               }
               return $car->getPosition();
            })->toArray();

        if(in_array('empty', $positionsEmpty)) {
            return true;
        }
        return false;
    }

    /**
     * @var Racing $racing
    */
    public function startRacing($racingName): void {
        $findRacingBegin = [
            'status' => RacingEnum::STARTED
        ];

        if($racing = $this->racingRepository->findOneBy($findRacingBegin)){
            echo "\nJá existe uma corrida iniciada, finalize {$racing->getName()}\n\n";
            exit;
        }

        $racing = $this->findByName($racingName);

        if($racing) {
            if($racing->isFinished()){
                echo "\nCorrida finalizada não pode ser iniciada novamente, cadastre uma nova corrida\n\n";
                exit;
            }

            if($this->isInvalid($racing)){
                echo "\nCorrida só pode ser iniciada com dois ou mais pilotos cadastrados!\n\n";
                exit;
            }

            if($this->existPilotInvalid($racing)){
                echo "\nExiste piloto sem posição definida!\n\n";
                exit;
            }

            $racing->setStatus(RacingEnum::STARTED);
            $this->entityManager->persist($racing);
            $this->entityManager->flush();
            echo "\nCorrida {$racingName} Iniciada\n\n";
            exit;
        }

        echo "\nCorrida {$racingName} Não Encontrada\n\n";
    }

    public function pauseRacing($racingName): void {
        $racing = $this->racingRepository->findOneBy([
            'name' => $racingName
        ]);

        if($racing) {
            $racing->setStatus(RacingEnum::PAUSED);
            $this->entityManager->persist($racing);
            $this->entityManager->flush();

            echo "\nCorrida pausada!\n\n";
            exit;
        }

        echo "\nCorrida {$racingName} Não Encontrada\n\n";
    }

    /**
     * @return Racing
    */
    public function fromArgvToFields($argv): Racing {
        $racing = new Racing();
        $racing->setName($argv[3]);
        $racing->setStatus(1);
        return $racing;
    }

    /**
     * @param Racing $racing
     * @throws \Exception
     */
    public function create(Racing $racing): void {
        $this->entityManager->persist($racing);
        $this->entityManager->flush();

        echo "\nCorrida criada!\n\n";
    }

    public function finish(String $racingName): void {
        $racing = $this->findByName($racingName);

        if($racing){
            $racing->setStatus(RacingEnum::FINISHED);
            $this->entityManager->persist($racing);
            $this->entityManager->flush();

            exit;
        }

        echo "\nCorrida {$racingName} Não Encontrada\n\n";
    }
}