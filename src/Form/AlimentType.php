<?php

namespace App\Form;

use App\Entity\Aliment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class AlimentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {   // l'ensemble des champs de notre formulaire lié à l'entity Aliment //
        $builder
            ->add('nom')
            ->add('prix')
            // element de type file pour l'image champ non obligatoire grace required //
            // ->add('imageFile', FileType::class, ['required' => false])
            ->add('imageFile',FileType::class, [
                'required' => false,              
            ])
            ->add('calories')
            ->add('proteine')
            ->add('glucide')
            ->add('lipide')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Aliment::class,
        ]);
    }
}
