<?php

namespace App\Form;

use App\Entity\Search\CourseSearch;
use App\Entity\Matiere;
use App\Entity\Promo;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourseSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule', TextType::class, ["label"=>"Intitulé du cours :", "required"=>false])
            ->add('date', DateType::class, ["label"=>"Date :", 'widget' => 'single_text', "required"=>false])
            ->add('idMatiere', EntityType::class, ["class"=>Matiere::class, "choice_label" =>"intitule", "label"=>"Matière :", "required"=>false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('q')
                        ->where("q.validationadmin=1");
                }])
            ->add('idPromo', EntityType::class, ["class"=>Promo::class, "choice_label" =>"promo", "label"=>"Difficulté :", "required"=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CourseSearch::class,
        ]);
    }
}
