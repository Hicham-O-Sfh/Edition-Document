<?php

namespace App\Form;

use App\Entity\Fonction;
use App\Entity\ListAffectation;
use App\Entity\Personnel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonnelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule', null, ['label' => 'matricule'])
            ->add('numCin', null, ['label' => 'CIN',
                'required' => true,])
            ->add('validiteCin', DateType::class, [
                'widget' => 'single_text',
                'label' => 'CIN validité',
                'required' => false,

            ])
            ->add('nomFr', null, ['label' => 'NOM'])
            ->add('utiliseApplication', null, ['label' => false])
            ->add('nomAr', null, [
                "label" => "الإسم العائلي"
            ])
            ->add('prenomFr', null, ['label' => 'Prenom'])
            ->add('prenomAr', null, [
                "label" => "الإسم الشخصي"
            ])
            ->add('nomConjointAr', null, ['label' => 'الإسم العائلي للزوج(ة)'])
            ->add('PrenomConjointAr', null, ['label' => 'الإسم الشخصي للزوج(ة)'])
            ->add('nomConjointFr', null, ['label' => 'nom Conjoint'])
            ->add('prenomConjointFr', null, ['label' => 'prenom Conjoint'])
            ->add('nombreEnfants', null, ['label' => "nombre d'enfants"])
            ->add('adresseFr', null, ['label' => 'Adresse'])
            ->add('adresseAr', null, ['label' => 'العنوان'])
            ->add('sexe', ChoiceType::class, [
                'choices' => [

                    'Masculin' => "Masculin",
                    'Féminin' => "Féminin",


                ],
                'label' => 'sexe'])
            ->add('dateNaissance', DateType::class, [
                'required' => false,
                'widget' => 'single_text',

                'by_reference' => true,

            ])
            ->add('dateDepart', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('lieuNaissance', null, ['label' => 'lieu de naissance'])
            ->add('numCnss', null, ['label' => 'num CNSS'])
            ->add('numCimr', null, ['label' => 'num CIMR'])
            ->add('telPersonnel', null, ['label' => 'Telephone personnel'])
            ->add('telProfessionnel', null, ['label' => 'telephone professionnel'])
            ->add('emailPersonnel', null, ['label' => 'email personnel'])
            ->add('dateEntree', DateType::class, [
                'widget' => 'single_text',
                'required' => true,

            ])
            ->add('motif')
            ->add('situationFamiliale', ChoiceType::class, [
                'choices' => [
                    '  ' => "  ",
                    'Célibataire' => "Célibataire",
                    'Marié(e)' => "Marié(e)",
                    'Divorcé(e)' => "Divorcé(e)",
                    'veuf(ve)' => "veuf(ve)",

                ]])
            ->add('salaire')
            ->add('banque')
            ->add('emailProfessionnel', null, ['label' => 'email professionnel'])
            ->add('numRib', null, ['label' => 'num RIB'])
            ->add('dateTitularisation', DateType::class, [

                'widget' => 'single_text',
                'required' => false,


            ])
            ->add('estPersonnel', null, ['label' => false ])
            ->add('photo')
            ->add('estChef',CheckboxType::class,[

                "required"=>false

            ])
            ->add('etat', ChoiceType::class, [
        'choices' => [
            '  ' => "  ",
            'Congé' => "Congé",
            'Mission' => "Mission",
            'Autre' => "Autre",
            'parti' => "parti",


        ]])

            ->add('typeContrat', null, ['label' => 'type de contrat'])
            ->add('personnelFonctions', null, ['label' => 'fonction'])
            ->add('fonctions', EntityType::class, [
                'class' => Fonction::class,
                'mapped' => false])
            ->add('affectations', EntityType::class, [
                'class' => ListAffectation::class,
                'mapped' => false])

            ->add('secteur')
            ->add('departement')
            ->add('nationalite', null, ['empty_data' => 'marocain'])
            ->add('file', FileType::class, [
                "mapped" => false,
                "label" => "photo",
                "required" => false
            ], [

                'empty_data' => "azd"]);

    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personnel::class,
        ]);
    }
}
