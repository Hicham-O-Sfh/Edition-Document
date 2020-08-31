<?php

namespace App\Form;

use App\Entity\ModelDocument;
use Doctrine\DBAL\Types\TextType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModelDocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
     

        $builder
            ->add('intitule',TypeTextType::class, ['attr' => ['class' => 'form-control'] ])
            ->add('details')   
            ->add('content',CKEditorType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ModelDocument::class,
        ]);
    }
}
