<?php

namespace App\Form;

use App\Entity\PersonnelDiplome;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonnelDiplomeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('dateObtention')
            ->add('etablissement')
            ->add('specialite')

            ->add('personnel')
            ->add('diplome')
            ->add('file',FileType::class,[
                "mapped"=>false,
                "label"=>"telecharger  photo"
            ],[
                'required'   => false,
                'data' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PersonnelDiplome::class,
        ]);
    }
}
