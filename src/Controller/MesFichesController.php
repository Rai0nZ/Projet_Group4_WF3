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
        $repository = $this->getDoctrine()->getRepository(Fiches::class);
        $fiches = $repository->findBy([
            'Auteur' => "Sabrina Tht"
        ]);

        return $this->render('mes_fiches/index.html.twig', [
            'fiches' => $fiches
        ]);    
    }
    /**
     * @Route("/{id}/edit", name="modifier_fiche", methods={"GET","POST"})
     */
    public function modifier_fiche(Request $request,Fiches $fiche): Response
    {
        $form = $this->createForm(CreerFicheType::class, $fiche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mes_fiches');
        }

        return $this->render('modifier-fiche.html.twig', [
            'fiches' => $fiche,
            'form' => $form->createView(),
        ]);
    }
        /**
     * @Route("/{id}", name="supprimer_fiche", methods={"DELETE"})
     */
    public function delete(Request $request, Fiches $fiche): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fiche->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fiche);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mes-fiches');
    }
}