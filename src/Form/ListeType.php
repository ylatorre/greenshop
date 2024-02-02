<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\FicheProduit;
use App\Entity\Liste;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numeroListe')
            ->add('typeListe')
            ->add('nomListe')
            ->add('quantity')
            ->add('user', EntityType::class, [
                'class' => User::class,
'choice_label' => 'id',
            ])
            ->add('commande', EntityType::class, [
                'class' => Commande::class,
'choice_label' => 'id',
            ])
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
            'data_class' => Liste::class,
        ]);
    }
}
