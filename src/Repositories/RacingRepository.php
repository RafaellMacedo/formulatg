<?php

namespace Formulatg\Repositories;

use Doctrine\ORM\EntityRepository;
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
     * @throws Exception
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

    public function findBy(String $name): Racing {
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

    public function beginRacing($nameRacing): void {
        $findRacingBegin = [
            'status' => RacingEnum::INICIADO
        ];

        if($racing = $this->racingRepository->findOneBy($findRacingBegin)){
            echo "\nJá existe uma corrida iniciada, finalize {$racing->getName()}\n\n";
            exit;
        }

        $racing = $this->racingRepository->findOneBy([
            'name' => $nameRacing
        ]);

        if($racing) {
            $racing->setStatus(RacingEnum::INICIADO);
            $this->entityManager->persist($racing);
            $this->entityManager->flush();
            echo "\nCorrida {$nameRacing} Iniciada\n\n";
            exit;
        }

        echo "\nCorrida {$nameRacing} Não Encontrada\n\n";
    }

    public function pauseRacing($nameRacing): void {
        $racing = $this->racingRepository->findOneBy([
            'name' => $nameRacing
        ]);

        if($racing) {
            $racing->setStatus(RacingEnum::PAUSADO);
            $this->entityManager->persist($racing);
            $this->entityManager->flush();

            echo "\nCorrida pausada!\n\n";
        }
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
}