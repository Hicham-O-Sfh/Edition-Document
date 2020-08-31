<?php

namespace App\Form;

use App\Entity\PersonnelConge;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PersonnelCongeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDebutConge', DateType::class, [
                'widget' => 'single_text',])
            ->add('dateFinConge', DateType::class, [
                'widget' => 'single_text',])
            ->add('natureConge')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PersonnelConge::class,
        ]);
    }
}
