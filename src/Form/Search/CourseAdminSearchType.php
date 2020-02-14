<?php

namespace App\Form\Search;

use App\Entity\Matiere;
use App\Entity\CourseSearch;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourseAdminSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', ChoiceType::class, ["label"=>"Status : ", "choices"=>["StandBy"=>0, "Cours clos"=>1, "Cours annulé"=>2], "required"=>false])
            ->add('idMatiere', EntityType::class, ["class"=>Matiere::class, "label"=>"Matière :", "required"=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CourseSearch::class,
            'csrf_protection' => false,
        ]);
    }
}
