<?php

namespace App\Form;

use App\Entity\Matiere;
use App\Entity\Promo;
use App\Entity\Proposition;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SuggestCoursesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idMatiere', EntityType::class, ["class"=>Matiere::class, "label"=>"Matière :",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('q')
                        ->where("q.validationAdmin=2");
                }])
            ->add('idPromo', EntityType::class, ["class"=>Promo::class, "label"=>"Difficulté :", "multiple"=>true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('q')
                        ->orderBy("q.promo", "ASC");
                }])
            ->add('submit', SubmitType::class, ["label" => "Ajouter la proposition"])
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Proposition::class,
        ]);
    }
}
