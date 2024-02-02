<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;

#[AsCommand(
    name: 'app:add-admin-user',
    description: 'Ajoute un nouvel utilisateur admin',
)]
class AddAdminUserCommand extends Command
{
    private $entityManager;
    private $passwordHasher;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }

    protected function configure(): void
    {
        $this
            // Configurez votre commande ici
            // Supprimez les arguments et options non utilisés
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Créer une instance de User
        $user = new User();
        $user->setEmail('email@admin.com'); // Remplacez par l'email réel
        $user->setNom('Nom'); // Ajoutez un nom réel
        $user->setPrenom('Prenom'); // Ajoutez un prénom réel
        $user->setTelephone('0123456789'); // Ajoutez un numéro de téléphone réel
        // Répétez pour tous les autres champs requis par votre entité User
        $user->setRoles(['ROLE_ADMIN']);
    
        // Hasher le mot de passe
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'psasword' // Remplacez par un mot de passe sécurisé
        );
        $user->setPassword($hashedPassword);
    
        // Enregistrer l'utilisateur
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    
        // Sortie de la commande
        $output->writeln('Admin user created successfully');
    
        return Command::SUCCESS;
    }
    

}
