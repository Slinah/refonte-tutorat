<?php

namespace App\Form;

use App\Entity\Matiere;
use App\Entity\PersonneTags;
use App\Entity\Tags;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TagsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idTag', EntityType::class, ["class"=>Tags::class, "label"=>"Tags :"])

            ->add('idMatiere', EntityType::class, ["class"=>Matiere::class, "label"=>"Matière :",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('q')
                        ->where("q.validationadmin=1");
                }])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PersonneTags::class,
        ]);
    }
}
