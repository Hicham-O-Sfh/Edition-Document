<?php

namespace App\Form;

use App\Entity\Secteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SecteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelleFr')
            ->add('libelleAr')
            ->add('code')
            ->add('adresse')
            ->add('email1')
            ->add('email2')
            ->add('fixe1')
            ->add('fixe2')
            ->add('gsm1')
            ->add('gsm2')
            ->add('fax')
            ->add('animateur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Secteur::class,
        ]);
    }
}
