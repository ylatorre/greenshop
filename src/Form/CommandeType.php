<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\Etat;
use App\Entity\Liste;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('createdAt')
            ->add('datePreparation')
            ->add('dateExpedie')
            ->add('dateRecu')
            ->add('numeroSuivi')
            ->add('user', EntityType::class, [
                'class' => User::class,
'choice_label' => 'id',
            ])
            ->add('idListe', EntityType::class, [
                'class' => Liste::class,
'choice_label' => 'id',
            ])
            ->add('idEtat', EntityType::class, [
                'class' => Etat::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
