<?php

namespace App\Form;

use App\Entity\Deposit;
use App\Entity\Exchange;
use App\Entity\FiatCurrency;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepositType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('depositedAt', DateTimeType::class, [
                'widget' => 'single_text',
                'required' => false,
                'input' => 'datetime_immutable',
                'label' => false,
            ])
            ->add('amount', NumberType::class, [
                'label' => false,
            ])
            ->add('type', EntityType::class, [
                'class' => \App\Entity\DepositType::class,
                'label' => false,
            ])
            ->add('exchange', EntityType::class, [
                'class' => Exchange::class,
                'label' => false,
            ])
            ->add('fiatCurrency', EntityType::class, [
                'class' => FiatCurrency::class,
                'label' => false,
                'choice_label' => 'symbol'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Deposit::class,
        ]);
    }
}
