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
     * @Route("/afficher-fiche", name="afficher_fiche")
     */
    public function afficherUneFiche(): Response {

        $repository = $this->getDoctrine()->getRepository(Fiches::class);
        // $fiche = $repository->find($id,$autheur);

        if (empty($fiche)) throw new NotFoundHttpException();

        return $this->render('afficher_fiche/index.html.twig', [
            'fiche' => $fiche->createView()

        ]);
    }
}
