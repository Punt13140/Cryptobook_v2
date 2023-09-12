<?php

namespace App\Form;

use App\Entity\Blockchain;
use App\Entity\Cryptocurrency;
use App\Entity\Dapp;
use App\Entity\Loan;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoanType extends AbstractType
{
    private FormFactoryInterface $factory;

    /**
     * @var array<string, mixed>
     */
    private array $dependencies = [];

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->factory = $builder->getFormFactory();

        $builder
            ->add('nbCoins')
            ->add('loanedAt', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
                'input' => 'datetime_immutable',
            ])
            ->add('coin', EntityType::class, [
                'class' => Cryptocurrency::class,
                'required' => true,
                'attr' => ['class' => 'js-select2'],
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'empty_data' => '',
            ])
            ->add('blockchain', EntityType::class, [
                'required' => false,
                'class' => Blockchain::class,
                'attr' => ['class' => 'js-select2'],
            ]);

        $builder->addEventListener(FormEvents::PRE_SET_DATA, [$this, 'onPreSetData']);
        $builder->addEventListener(FormEvents::POST_SUBMIT, [$this, 'onPostSubmit']);

        $builder->get('blockchain')->addEventListener(FormEvents::POST_SUBMIT, [$this, 'storeDependencies']);
        $builder->get('blockchain')->addEventListener(FormEvents::POST_SUBMIT, [$this, 'onPostSubmitBlockchain']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Loan::class,
        ]);
    }

    public function onPreSetData(FormEvent $event): void
    {
        /** @var Loan $data */
        $data = $event->getData();

        $this->addDappField($event->getForm(), $data?->getBlockchain(), $data?->getDapp());
    }

    public function onPostSubmit(FormEvent $event): void
    {
        $this->dependencies = [];
    }

    public function storeDependencies(FormEvent $event): void
    {
        $this->dependencies[$event->getForm()->getName()] = $event->getForm()->getData();
    }

    public function onPostSubmitBlockchain(FormEvent $event): void
    {
        $this->addDappField(
            $event->getForm()->getParent(),
            $this->dependencies['blockchain'],
        );
    }

    public function addDappField(FormInterface $form, ?Blockchain $blockchain, Dapp $dapp = null): void
    {
        $dappForm = $this->factory->createNamedBuilder('dapp', EntityType::class, $dapp, [
            'class' => Dapp::class,
            'placeholder' => null === $blockchain ? 'Select a blockchain first' : sprintf('What dapp in %s?', $blockchain->getLibelle()),
            'choices' => $blockchain?->getDapps(),
            'disabled' => null === $blockchain,
            'invalid_message' => false,
            'auto_initialize' => false,
        ]);
        //            ->addEventListener(FormEvents::POST_SUBMIT, [$this, 'storeDependencies'])
        //            ->addEventListener(FormEvents::POST_SUBMIT, [$this, 'onPostSubmitFood']);

        $form->add($dappForm->getForm());
    }
}
