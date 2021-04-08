<?php

namespace App\Controller;

use App\Entity\Fiches;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class AfficherFicheController extends AbstractController
{
    /**
     * @Route("/afficher-fiche/{id}", name="afficher_fiche")
     */
    public function afficherUneFiche(Fiches $fiche): Response
    {
        // le fait de passer en paramètre Fiches $fiche remplace les trois lignes de code qui suivent 
        // car Fiches = l'entité donc la doctrine et la variable est rempli automatiquement par Symfony
        // Enfin Symfony gère automatiquement les NotFoundHttpException si la page n'existe pas
        
        // $repository = $this->getDoctrine()->getRepository(Fiches::class);
        // $fiche = $repository->find($id);

        // if (empty($fiche)) throw new NotFoundHttpException();

        return $this->render('afficher_fiche/index.html.twig', [
            'fiche' => $fiche
        ]);
    }
}
