<?php

namespace App\Controller;

use App\Entity\Fiches;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MesFichesController extends AbstractController
{
    /**
     * @Route("/mes-fiches", name="mes_fiches")
     */
    public function voirMesFiches(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Fiches::class);
        $fiches = $repository->findBy([
            'Auteur' => "Sabrina Tht"
        ]);

        return $this->render('mes_fiches/index.html.twig', [
            'fiches' => $fiches
        ]);    
    }


    
}