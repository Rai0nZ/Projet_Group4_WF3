<?php

namespace App\Controller;

use App\Entity\Fiches;
use App\Form\CreerFicheType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreerFicheController extends AbstractController {
    /**
     * @Route("/creer-fiche", name="creer_fiche")
     */
    public function index(Request $r): Response
    {

        $creerFiche = new Fiches();

        $form = $this->createForm(CreerFicheType::class, $creerFiche);

        $form->handleRequest($r);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->render('creer-fiche/index.html.twig', [
                'form' => $form->createView()
            ]);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($creerFiche);
        $em->flush();

        // return $this->redirect('/fiche/' . $creerFiche->getId());

    }
}
