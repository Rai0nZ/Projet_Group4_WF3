<?php

namespace App\Controller;

use App\Entity\Fiches;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SuiviController extends AbstractController
{
    /**
     * @Route("/suivi/{id}", name="suivi")
     */
    public function SuivreUneFiche(Fiches $fiche): Response
    {

        if (!$this->isGranted('ROLE_USER')) {
            return $this->redirect('/Accueil');
        }

        $user = $this->getUser();
        

        if (!empty($user->getSuivis())) {
            return $this->redirectToRoute('afficher_fiche', ['id' => $fiche->getId()]);
        } else {
           
            $em = $this->getDoctrine()->getManager();

            $user->setSuivis($fiche);

            $em->persist($user);
            $em->flush();
        }

        return $this->redirect('/afficher-fiche/' . $fiche->getId());
    }
}
