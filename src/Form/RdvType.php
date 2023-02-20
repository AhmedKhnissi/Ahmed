<?php

namespace App\Form;

use App\Entity\Decision;
use App\Entity\RendezVous;
use App\Entity\Veterinaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RdvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $veterinaire = $options['veterinaire'] ?? null;
        $builder
            ->add('date', TextType::class, [
                'attr'=>['placeholder'=>'Date JJ/MM/YYYY']
            ])
            ->add('heure', TextType::class, [
                'attr'=>['placeholder'=>'Heure HH:MM']
            ])

            ->add('raceanimal', TextType::class, [
                'attr'=>['placeholder'=>'La Race De Votre Animal']
            ])
            ->add('nomanimal', TextType::class, [
                'attr'=>['placeholder'=>'Le Nom De Votre Animal']
            ])
            ->add('Veterinaire', EntityType::class, [
                'class'=>Veterinaire::class,
                'choice_label'=>'name',
                'data' => $veterinaire
            ])
            ->add('Decision', EntityType::class, [
                'class' => Decision::class,
                'choice_label' => 'affectation',

            ]);



    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RendezVous::class,
            'veterinaire' => null, // set the default value for the "veterinaire" option
        ]);
    }
}
