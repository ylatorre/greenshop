<?php

    namespace App\Controller;

    use App\Entity\Liste;
    use App\Form\ListeType;
    use App\Repository\ListeRepository;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FicheProduitRepository;

    #[Route('/liste')]
    class ListeController extends AbstractController
    {
        
        #[Route('/', name: 'app_liste_index', methods: ['GET'])]
        public function index(ListeRepository $listeRepository): Response
        {
            return $this->render('liste/index.html.twig', [
                'listes' => $listeRepository->findAll(),
            ]);
        }

        #[Route('/new', name: 'app_liste_new', methods: ['GET', 'POST'])]
        public function new(Request $request, EntityManagerInterface $entityManager): Response
        {
            $liste = new Liste();
            $form = $this->createForm(ListeType::class, $liste);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($liste);
                $entityManager->flush();

                return $this->redirectToRoute('app_liste_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->render('liste/new.html.twig', [
                'liste' => $liste,
                'form' => $form,
            ]);
        }

        #[Route('/{id}', name: 'app_liste_show', methods: ['GET'])]
        public function show(Liste $liste): Response
        {
            return $this->render('liste/show.html.twig', [
                'liste' => $liste,
            ]);
        }

        #[Route('/{id}/edit', name: 'app_liste_edit', methods: ['GET', 'POST'])]
        public function edit(Request $request, Liste $liste, EntityManagerInterface $entityManager): Response
        {
            $form = $this->createForm(ListeType::class, $liste);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->flush();

                return $this->redirectToRoute('app_liste_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->render('liste/edit.html.twig', [
                'liste' => $liste,
                'form' => $form,
            ]);
        }

        #[Route('/{id}', name: 'app_liste_delete', methods: ['POST'])]
        public function delete(Request $request, Liste $liste, EntityManagerInterface $entityManager): Response
        {
            if ($this->isCsrfTokenValid('delete'.$liste->getId(), $request->request->get('_token'))) {
                $entityManager->remove($liste);
                $entityManager->flush();
            }

            return $this->redirectToRoute('app_liste_index', [], Response::HTTP_SEE_OTHER);
        }


        #[Route('/ajouter-produit-a-liste/{idProduit}', name: 'ajouter_produit_a_liste', methods: ['POST'])]
        public function ajouterProduitAListe(Request $request, $idProduit, ListeRepository $listeRepository, FicheProduitRepository $produitRepository, EntityManagerInterface $entityManager): Response
        {
            $user = $this->getUser();
            if (!$user) {
                return $this->redirectToRoute('app_login');
            }
        
            $listeId = $request->request->get('listeId');
            $liste = $listeRepository->findOneBy(['id' => $listeId, 'user' => $user]);
        
            if (!$liste) {
                // Gérer l'erreur si la liste n'existe pas ou n'appartient pas à l'utilisateur
                return $this->redirectToRoute('une_route', ['erreur' => 'Liste non trouvée']);
            }
        
            $produit = $produitRepository->find($idProduit);
            if (!$produit) {
                // Gérer l'erreur si le produit n'existe pas
                return $this->redirectToRoute('une_autre_route', ['erreur' => 'Produit non trouvé']);
            }
        
            // Ajouter le produit à la liste
            $liste->addFicheProduit($produit);
            $entityManager->flush();
        
            // Rediriger vers la page de la liste ou une autre page de confirmation
            return $this->redirectToRoute('app_liste_index');
        }


        // Dans votre contrôleur, par exemple ListeController.php

#[Route('/ajouter-liste-au-panier/{idListe}', name: 'ajouter_liste_au_panier')]
public function ajouterListeAuPanier(int $idListe, ListeRepository $listeRepository, EntityManagerInterface $entityManager): Response
{
    $liste = $listeRepository->find($idListe);
    $user = $this->getUser();

    if (!$liste || !$user) {
        // Gérer l'erreur si la liste n'existe pas ou l'utilisateur n'est pas connecté
        return $this->redirectToRoute('homepage'); // Rediriger vers une page appropriée
    }

    // Ici, vous devriez avoir une logique pour ajouter tous les produits de la liste au panier de l'utilisateur
    // Cela dépend de la structure de votre entité Panier et de la manière dont vous gérez les paniers dans votre application

    // Exemple simplifié:
    foreach ($liste->getFicheProduits() as $produit) {
        // Ajouter chaque produit au panier de l'utilisateur
        // Vous devez remplacer cette partie par votre propre logique d'ajout au panier
    }

    $entityManager->flush(); // Assurez-vous de persister les changements si nécessaire

    // Rediriger vers le panier ou une autre page de confirmation
    return $this->redirectToRoute('app_liste_index');
}

        



    }

