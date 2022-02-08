<?php

namespace App\Form;


use App\Entity\RessourceEntity;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RessourceEntityFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('price', null,[
                'attr' => [
                    'autofocus' => true,
                ]
            ])
            ->add('coeff_pepite')
            ->add('bonus', NumberType::class,[
                'attr' => [
                    'value' => 0,
                ],
            ])
            ->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RessourceEntity::class,
        ]);
    }
}
