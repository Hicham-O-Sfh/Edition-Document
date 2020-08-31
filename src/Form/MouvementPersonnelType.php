<?php

namespace App\Form;

use App\Entity\MouvementPersonnel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MouvementPersonnelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateAffectation', DateType::class, [
                'widget' => 'single_text',

            ])
            ->add('dateFin', DateType::class, [

                'widget' => 'single_text',
                "required"=> false,

                'attr' => ['class' => 'form-control'],

            ])
            ->add('observation')

            ->add('numDecision')
            ->add('dateDecision', DateType::class, [
                'widget' => 'single_text',

            ])

            ->add('lieuAffectation')
            ->add('typeAffectation',ChoiceType::class, [
                'choices'  => [
                    '  ' => "  ",
                    'mutation' => "mutation",
                    'nouvelle affectation' => "nouvelle affectation",
                    'autre' => "autre",


                ]])
            ->add('duree')
            ->add('decision' ,ChoiceType::class, [
        'choices'  => [
            '  ' => "  ",
            'en cours' => "en cours",
            'accepté' => "accepté",
            'refusé' => "refusé",


        ]])
            ->add('personnel', null,[

                "required"=>true
            ])
            ->add('file',FileType::class,[
                "mapped"=>false,
                "required" => false

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MouvementPersonnel::class,
        ]);
    }
}
