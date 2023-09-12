<?php

namespace App\EventListener;

use App\Entity\OwnedByUser;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;
use Symfony\Bundle\SecurityBundle\Security;

#[AsDoctrineListener(event: Events::prePersist, priority: 500, connection: 'default')]
class HandleOwner
{
    public function __construct(
        private readonly Security $security,
    ) {
    }

    /**
     * @throws \LogicException
     */
    public function prePersist(PrePersistEventArgs $args): void
    {
        if (null === $this->security->getUser()) {
            throw new \LogicException('User must be logged in');
        }

        $entity = $args->getObject();

        if (!$entity instanceof OwnedByUser || null !== $entity->getOwner()) {
            return;
        }

        $entity->setOwner($this->security->getUser());
    }
}
