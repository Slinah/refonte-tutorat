<?php

namespace App\Form;

use App\Entity\Cours;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CloseCoursesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('commentaires', TextType::class, ['label'=>'Commentaire : ', 'attr'=>["placeholder"=>"Problèmes précis / sujets abordés ..."] , 'required'=>true])
            ->add('nbparticipants', IntegerType::class, ['label'=>'Nombre de personnes ayant participées :', 'required'=>true])
            ->add('duree', IntegerType::class, ['label'=>"Nombre d'heures : "])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
