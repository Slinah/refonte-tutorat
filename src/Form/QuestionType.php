<?php

namespace App\Form;

use App\Entity\QuestionForum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                'label' => 'Votre question'
            ])
            ->add('description', null, [
                'label' => 'Détaillez votre idée'
            ])
//            ->add('matiere', null, [
//                'label' => 'Selectionnez la matiere'
//            ])
            ->add('submit', SubmitType::class, [
                "label" => "Envoyer !"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => QuestionForum::class,
        ]);
    }
}
