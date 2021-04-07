<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class AuthentificationController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('homepage');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/Inscription", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder) {

        $user = new User();

        $form = $this->createFormBuilder()

            ->add('email', EmailType::class, [
                'label' => 'Email',
                'constraints' => [
                    new NotBlank(),
                    new Email()
                ]
            ])
            ->add('pseudo', TextType::class, [
                'label' => 'Pseudo',
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 8
                    ])
                ]
            ])
            ->add('check_password', PasswordType::class, [
                'label' => 'Confirmation du Mot de Passe',
                'constraints' => [
                    new EqualTo([
                        'propertyPath' => 'password'
                    ])
                ]
            ])

            ->add('numen', TextType::class,[
                'label' => 'NUMEN'
                ])

            ->add('submit', SubmitType::class, [
                'label' => 'Créer un compte'
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           dd($user); 
            $user = new User();
            
            $formData = $form->getData();

            $encodedPassword = $encoder->encodePassword($user, $formData['password']);
            
            $user->setPassword($encodedPassword);
            $user->setPseudo($formData['pseudo']);
            $user->setEmail($formData['email']);
            $user->setEmail($formData['numen']);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('Accueil');
        } else {
            return $this->render('security/register.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

}
