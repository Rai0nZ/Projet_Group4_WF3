<?php

namespace App\Controller;

use App\Entity\Fiches;
use App\Repository\FichesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeFichesController extends AbstractController
{
    /**
     * @Route("/liste_fiches", name="liste_fiches")
     */
    public function listeFiches(): Response {
        $repository = $this->getDoctrine()->getRepository(Fiches::class);
        $fiches = $repository->findAll($Auteur);

        return $this->render('liste_fiches/index.html.twig', [
            'fiches' => $fiches
        ]);
    }
}
