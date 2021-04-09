<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccessibiliteController extends AbstractController
{
    /**
     * @Route("/accessibilite", name="accessibilite")
     */
    public function accessibilite(): Response
    {
        return $this->render('accessibilite/index.html.twig', [
            'controller_name' => 'AccessibiliteController',
        ]);
    }
}
