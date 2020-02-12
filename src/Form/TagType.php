<?php

namespace App\Form;

use App\Entity\Matiere;
use App\Entity\Niveau;
use App\Entity\PersonneTag;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idNiveau', EntityType::class, ["class"=>Niveau::class, "label"=>"Tag : ", "required"=>true])

            ->add('idMatiere', EntityType::class, ["class"=>Matiere::class, "label"=>"Matière : ", "required"=>true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('q')
                        ->where("q.validationadmin=1");
                }])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PersonneTag::class,
        ]);
    }
}
