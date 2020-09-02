<?php

namespace App\Form;

use App\Entity\ModelDocument;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModelDocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'intitule',
                TextType::class,
                [
                    'required'   => true,
                ]
            )
            ->add(
                'details',
                TextareaType::class,
                [
                    'attr' => ['rows' => 5],
                    'required'   => true,
                ]
            )
            ->add(
                'content',
                CKEditorType::class,
                [
                    'config' => ['uiColor' => '#ffffff'],
                    'required'   => true,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ModelDocument::class,
        ]);
    }
}
