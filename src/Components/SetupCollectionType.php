<?php

namespace App\Components;

use App\Entity\User;
use App\Form\SetupType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveCollectionTrait;

#[AsLiveComponent('setup_form')]
class SetupCollectionType extends AbstractController
{
    use DefaultActionTrait;
    use LiveCollectionTrait;

    #[LiveProp]
    public ?User $user;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(
            SetupType::class,
            $this->user
        );
    }
}