<?php

namespace App\Controller;

use App\Entity\Fiches;
use App\Entity\Vote;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoteController extends AbstractController
{
    /**
     * @Route("/a-voter/{id}", name="vote")
     */

    public function voterPourUneFiche(Fiches $fiche): Response
    {

        if (!$this->isGranted('ROLE_ADMIN')) {
            return $this->redirect('/Accueil');
        }

        $user = $this->getUser();

        $repository = $this->getDoctrine()->getRepository(Vote::class);
        $votes = $repository->findBy([
            'fiche' => $fiche,
            'utilisateur' => $user
        ]);

        if (!empty($votes)) {
            return $this->redirectToRoute('afficher_fiche', ['id' => $fiche->getId()]);
        } else {

            $vote = new Vote();

            $vote->setUtilisateur($user);
            $vote->setFiche($fiche);

            $em = $this->getDoctrine()->getManager();
            $em->persist($vote);
            $em->flush();
        }

        return $this->redirect('/afficher-fiche/' . $fiche->getId());
    }
}
