<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormulaireContactController extends AbstractController
{
    /**
     * @Route("/formulaire-contact", name="formulaire_contact")
     */
    public function index(): Response
    {

        $form = $this->createFormBuilder()
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class)
            ->add('Soumettre', SubmitType::class)
            ->getForm();

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->render('formulaire_contact/confirmation.html.twig', [
                'form' => $form->createView()
            ]);
        } else {
            return $this->render('formulaire_contact/index.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }
}
