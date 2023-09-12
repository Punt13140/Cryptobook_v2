<?php

namespace App\EventListener;

use App\Entity\Cryptocurrency;
use App\Service\CryptocurrencyService;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;

#[AsDoctrineListener(event: Events::prePersist, priority: 500, connection: 'default')]
class CreateCryptocurrency
{
    public function __construct(
        private readonly CryptocurrencyService $cryptocurrencyService,
    ) {
    }

    public function prePersist(PrePersistEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof Cryptocurrency || null !== $entity->getLibelle()) {
            return;
        }

        $this->cryptocurrencyService->updateDatas($entity);
    }
}
