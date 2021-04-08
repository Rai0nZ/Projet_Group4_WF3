<?php

namespace App\Controller;

use App\Entity\Fiches;
use App\Form\CreerFicheType;
use DateTime;
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

        $fiche = new Fiches();

        $form = $this->createForm(CreerFicheType::class, $fiche);
    
        $form->handleRequest($r);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->render('creer-fiche/index.html.twig', [
                'form' => $form->createView()

            ]);
        }
        
        $fiche->setDate(new DateTime());
        $fiche->setAuteur($this->getUser());
        $em = $this->getDoctrine()->getManager();
        $em->persist($fiche);
        $em->flush();


        return $this->redirect('/afficher-fiche/' . $fiche->getId());

    }
    
}

