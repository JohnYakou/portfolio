<?php

namespace App\Form;

use App\Entity\Langage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LangageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('langage', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('logo', FileType::class, ['required'=>false, 'data_class' => null, ], ['attr' => ['class' => 'form-control p-3']])
            ->add('submit', SubmitType::class, ['attr' => ['class' => 'btn btn-primary mt-3'], 'label' => 'Envoyez'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Langage::class,
        ]);
    }
}
