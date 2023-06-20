<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [ 
                    'class' => 'form-control' //attribut boostrap pour les element du form
                ]
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom complet',
                'attr' => [ 
                    'class' => 'form-control'
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse',
                'attr' => [ 
                    'class' => 'form-control'
                ]
            ])
            ->add('cp', TextType::class, [
                'label' => 'Code postale',
                'attr' => [ 
                    'class' => 'form-control'
                ]
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone',
                'attr' => [ 
                    'class' => 'form-control'
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => [ 
                    'class' => 'form-control'
                ]
            ])
            ->add('country', TextType::class, [
                'label' => 'Pays',
                'attr' => [ 
                    'class' => 'form-control'
                ]
                ])
            //->add('user')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
