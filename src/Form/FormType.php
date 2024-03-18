<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class FormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first',TextType::class,[
                'label' => 'First integer',
                'attr' => [
                    'placeholder' => 'int'
                ]
            ])
            ->add('second',TextType::class,[
                'label' => 'Second integer',
                'attr' => [
                    'placeholder' => 'int'
                ]
            ])
            ->add('save',SubmitType::class,[
                'attr' => [
                    'class' => 'btn btn-primary mt-2'
                ]
            ])
        ;
    }

   
}
