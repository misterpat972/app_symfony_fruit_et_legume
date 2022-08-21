<?php

namespace App\Form;

use App\Entity\Type;
use App\Entity\Aliment;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AlimentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {   // l'ensemble des champs de notre formulaire lié à l'entity Aliment //
        $builder
            ->add('nom')
            ->add('prix')
            //element de type file pour l'image champ non obligatoire grace required //
            ->add('imageFile', FileType::class, ['required' => false,
            'label' => 'image'])                  
            ->add('calories')
            ->add('proteine')
            ->add('glucide')
            ->add('lipide')
            // ici on a rappelé le champ type de l'entity Type en ajoutant sur quel champ on veux faire le choix//
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'libelle',
                'label' => 'Type'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Aliment::class,
        ]);
    }
}
