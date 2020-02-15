<?php


namespace App\Form\Filter;


use App\Entity\Year;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartnerFilter extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('year', EntityType::class, [
                'class' => Year::class,
                'required' => false,
                'placeholder' => 'Année',
                'query_builder' => function(EntityRepository $repository) {
                    $dql = $repository->createQueryBuilder('year');

                    $dql->orderBy('year.id','DESC');

                    return $dql;
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'method' => 'GET',
            'allow_extra_fields' => true
        ]);
    }
}