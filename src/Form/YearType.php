<?php

namespace App\Form;

use App\Entity\Year;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class YearType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', NumberType::class, [
                'label' => 'Année',
                'html5' => true,
                'attr' => [
                    'min' => 2020
                ]
            ])
            ->add('page', PageType::class)
            ->add('linkSign', TextType::class, [
                'label' => 'iFrame Inscription Google Doc',
                'required' => false
            ])
            ->add('linkNews', TextType::class, [
                'label' => 'Liens "News"',
                'required' => false
            ])
            ->add('linkPilotes', TextType::class, [
                'label' => 'Liens "Pilotes"',
                'required' => false
            ])
            ->add('linkResults', TextType::class, [
                'label' => 'Liens "Epreuves & Résultats"',
                'required' => false
            ])
            ->add('linkDownload', TextType::class, [
                'label' => 'Liens "Téléchargement"',
                'required' => false
            ])
            ->add('linkGalery', TextType::class, [
                'label' => 'Liens "Gallerie"',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Year::class,
        ]);
    }
}
