<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\RapportMedical;
use App\Entity\RendezVous;
use App\Entity\Veterinaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportMedicalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $animal = $options['animal'] ?? null;
        $builder
            ->add('Description', TextType::class, [
                'attr'=>['placeholder'=>'Rapport Médical']
            ])
            ->add('Animal', EntityType::class, [
                'class'=>Animal::class,
                'choice_label'=>'nom',
                'data' => $animal
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RapportMedical::class,
            'animal' => null, // set the default value for the "animal" option
        ]);
    }
}
