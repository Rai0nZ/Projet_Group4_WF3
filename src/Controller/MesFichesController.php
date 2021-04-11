<?php

namespace App\Controller;

use App\Entity\Fiches;
use App\Form\CreerFicheType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MesFichesController extends AbstractController
{
    /**
     * @Route("/mes-fiches", name="mes_fiches")
     */
    public function voirMesFiches(): Response
    {
        
        if ($this->isGranted('ROLE_ADMIN')) 
        {
            $user = $this->getUser();

            $repository = $this->getDoctrine()->getRepository(Fiches::class);
            $fiches = $repository->findBy([
                'auteur' => $user
            ]);

            return $this->render('mes_fiches/index.html.twig', [
                'fiches' => $fiches
            ]);
        }else{
            $user = $this->getUser();

            $repository = $this->getDoctrine()->getRepository(Fiches::class);
            $fiches = $repository->findBy([
                'utilisateurs_enregistrees' => $user
            ]);

            return $this->render('mes_fiches/index.html.twig', [
                'fiches' => $fiches
            ]);
        }
    }



    /**
     * @Route("/modifier-fiche/{id}", name="modifier_fiche", methods={"GET","POST"})
     */
    public function modifier_fiche(Request $request, Fiches $fiche): Response
    {

        if ($this->getUser() != $fiche->getAuteur()) {
            return $this->redirectToRoute('homepage');
        }

        $form = $this->createForm(CreerFicheType::class, $fiche);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mes_fiches');
        }

        return $this->render('mes_fiches/modifier-fiche.html.twig', [
            'fiche' => $fiche,
            'form' => $form->createView(),
        ]);
    }

   /**
     * @Route("/supprimer-une-fiche/{id}", name="supprimer_fiche")
     */
    public function supprimerUneFiche($id): Response {

        $repo = $this->getDoctrine()->getRepository(getRepository::class);
        $fiche = $repo->find($id);


        $em = $this->getDoctrine()->getManager();
        $em->remove($fiche);
        $em->flush();

        return $this->redirectToRoute('mes_fiches');
    }
}