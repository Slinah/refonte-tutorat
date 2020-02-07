<?php

namespace App\Form\Search;

use App\Entity\Matiere;
use App\Entity\Search\MatiereSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatiereAdminSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('validationAdmin', ChoiceType::class, ["label"=>"Validation : ", "choices"=>["Non validé"=>0, "Validé"=>1], "required"=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MatiereSearch::class,
            'csrf_protection' => false,
        ]);
    }
}
