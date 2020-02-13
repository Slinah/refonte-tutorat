<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\PersonneSearch;
use App\Entity\Promo;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonneSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('role', ChoiceType::class, ["label"=>"Rôle :", "choices"=>["User"=>1, "Admin"=>2], "required"=>false])
            ->add('idClasse', EntityType::class, ["class"=>Promo::class, "label"=>"Promo", "required"=>false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('q')
                        ->orderBy("q.promo", "ASC");
                }])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PersonneSearch::class,
            'csrf_protection' => false,
        ]);
    }
}
