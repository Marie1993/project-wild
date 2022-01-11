<?php

namespace App\Form;

use App\Entity\Argonauts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArgonautUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom de l'Argonaute",
                'required' => true,
                'attr' => array(
                    'placeholder' => 'Votre nom')
            ])
            ->add('role', ChoiceType::class, [
                'label' => "Votre Statut",
                'choices' => [
                    'archer' => 'archer',
                    'épéiste' => 'épéiste',
                    'cuisinier' => 'cuisinier',
                    'médecin' => 'médecin',
                ],
                'multiple' => false

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Argonauts::class,
        ]);
    }
}
