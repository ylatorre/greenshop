<?php

namespace App\Form;

use App\Entity\EcoScore;
use App\Entity\FicheProduit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EcoScoreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label')
            ->add('score')
            ->add('maxScore')
            ->add('normes')
            ->add('ficheProduits', EntityType::class, [
                'class' => FicheProduit::class,
'choice_label' => 'id',
'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EcoScore::class,
        ]);
    }
}
