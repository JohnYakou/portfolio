<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, ['attr' => ['class' => 'form-control text-dark my-2', 'placeholder' => 'Nom']])
            ->add('prenom', TextType::class, ['attr' => ['class' => 'form-control text-dark my-2', 'placeholder' => 'Prénom'], 'label' => 'Prénom'])
            ->add('email', EmailType::class, ['attr' => ['class' => 'form-control text-dark my-2', 'placeholder' => 'Adresse email']])
            ->add('message', TextareaType::class, ['attr' => ['class' => 'form-control text-dark my-2', 'placeholder' => 'Écrivez votre message']])
            ->add('submit', SubmitType::class, ['attr' => ['class' => 'btn btn-primary mt-3 my-4', 'onclick'=>"return confirm('Envoyez votre message ?')"], 'label' => 'Envoyez le message', ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
