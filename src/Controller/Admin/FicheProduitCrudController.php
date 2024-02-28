<?php

namespace App\Controller\Admin;

use App\Entity\FicheProduit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField; // Ajoutez cette ligne
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField; // Ajoutez cette ligne
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField; // Ajoutez cette ligne
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField; // Ajoutez cette ligne

class FicheProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FicheProduit::class;
    }

    
    public function configureFields(string $pageName): iterable
{
    return [
        TextField::new('titre'),
        TextField::new('description')->hideOnIndex(),
        TextField::new('stock'),
        NumberField::new('noteProduit'),
        NumberField::new('nombreDeVente'),
        BooleanField::new('recyclage'),
        NumberField::new('prix'),

        // Utilisez AssociationField pour les relations ManyToOne ou ManyToMany
        AssociationField::new('idEtat')->setFormTypeOption('choice_label', 'label'), // Spécifiez 'label' comme la propriété à afficher
        AssociationField::new('idFournisseur')->setFormTypeOption('choice_label', 'nom'), // Spécifiez 'nom' comme la propriété à afficher
        AssociationField::new('idCategorie')->setFormTypeOption('choice_label', 'nom')->hideOnIndex(), // Spécifiez 'nom' comme la propriété à afficher
        AssociationField::new('idEcoScore')->setFormTypeOption('choice_label', 'label')->hideOnIndex(), // Spécifiez 'label' comme la propriété à afficher

        // Pour une collection de photos ou autres entités liées
        CollectionField::new('idPhoto')
            ->hideOnIndex() // Cacher sur la liste, montrer dans le détail ou la modification
            // Vous pouvez personnaliser davantage, par exemple en spécifiant un format
    ];
}
    
}
