<?php

namespace App\Form;

use App\Entity\PersonnelMission;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class PersonnelMissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('destination')
            ->add('moyenTransport')
            ->add('dateDepart', DateType::class, [
                'widget' => 'single_text',])
            ->add('dateRetour', DateType::class, [
                'widget' => 'single_text',])    
            ->add('observation')
            ->add('libeleMissionFR')
            ->add('libeleMissionAR')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PersonnelMission::class,
        ]);
    }
}
