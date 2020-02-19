<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule', TextType::class, ["label"=>"Nom du message :", "attr"=>["placeholder"=>"J'ai un bug avec le forum"], "required"=>true])

            ->add('message', TextAreaType::class, ["label"=>"Message :", "attr"=>["placeholder"=>"Veuillez détailler"], "required"=>true])
            ->add('mail', TextType::class, ["label"=>"Adresse email :", "attr"=>["placeholder"=>"Entrez votre adresse email"], "required"=>true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
