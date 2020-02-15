<?php

namespace App\Form;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use App\Entity\Contest;
use App\Entity\Partner;
use App\Entity\Thank;
use App\Entity\Year;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('year', EntityType::class, [
                'class' => Year::class,
                'label' => 'Année',
                'query_builder' => function(EntityRepository $repository) {
                    $dql = $repository->createQueryBuilder('year');

                    $dql->orderBy('year.id','DESC');

                    return $dql;
                }
            ])
            ->add('link', TextType::class, [
                'label' => 'Lien',
                'required' => false
            ])
            ->add('file', FileType::class, [
                'label' => 'Logo',
                'required' => false
            ])
            ->add('translations', TranslationsType::class, [
                'label' => 'Traductions',
                'fields' => [
                    'title' => [
                        'label' => 'Titre',
                        'field_type' => TextType::class
                    ]
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Partner::class,
        ]);
    }
}
