<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Matiere;
use App\Entity\Promo;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GiveCoursesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule', TextType::class, ["label"=>"Intitulé du cours :", "attr"=>["placeholder"=>"Faire des tableaux de chatons"], "required"=>true])
            ->add('date', DateType::class, ["label"=>"Date :", 'widget' => 'single_text', "required"=>true])
            ->add('heure', TimeType::class, ["label"=>"Heure :", "required"=>true])


            ->add('idMatiere', EntityType::class, ["class"=>Matiere::class, "label"=>"Matière :",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('q')
                        ->where("q.validationAdmin=2");
                }])
            ->add('idPromo', EntityType::class, ["class"=>Promo::class, "label"=>"Difficulté :",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('q')
                        ->orderBy("q.promo", "ASC");
                }])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
