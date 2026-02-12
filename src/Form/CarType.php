<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('monthlyPrice', NumberType::class, [
                'html5' => true,
                'attr' => [
                    'type' => 'number',
                    'step' => 1,
                    'min' => 0,
                ],
            ])
            ->add('dailyPrice', NumberType::class, [
                'html5' => true,
                'attr' => [
                    'type' => 'number',
                    'step' => 1,
                    'min' => 0,
                ],
            ])
            ->add('seatNumber', ChoiceType::class, [
                'choices'  => array_combine(range(1, 9), range(1, 9)),
            ])
            ->add('manualTransmission', ChoiceType::class, [
                'choices'  => [
                    'Manuelle' => true,
                    'Automatique' => false,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
