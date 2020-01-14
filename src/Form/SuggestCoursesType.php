<?php

namespace App\Form;

use App\Entity\Matiere;
use App\Entity\Personne;
use App\Entity\Promo;
use App\Entity\Proposition;
use App\Repository\MatiereRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SuggestCoursesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idMatiere', EntityType::class, ["class"=>Matiere::class, "choice_label" =>"intitule", "label"=>"Matière :",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('q')
                        ->where("q.validationadmin=1");
                }])
            ->add('idPromo', EntityType::class, ["class"=>Promo::class, "choice_label" =>"promo", "label"=>"Difficulté :",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('q')
                        ->orderBy("q.promo", "ASC");
                }])
            ->add('idPersonne', EntityType::class, ["class"=>Personne::class, "choice_label" =>"id_personne", "label"=>"Personne :"])
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Proposition::class,
        ]);
    }
}
