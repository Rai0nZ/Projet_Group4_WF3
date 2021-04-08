<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
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
            return $this->redirectToRoute('app_login');
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
    {}

    /**
     * @Route("/Inscription", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder) {

        $form = $this->createFormBuilder()

        ->add('nom', TextType::class, [
            'label' => 'Nom',
            'constraints' => [
                new NotBlank(),
            ]
        ])
        ->add('prenom', TextType::class, [
            'label' => 'Prenom',
            'constraints' => [
                new NotBlank(),
            ]
        ])
        // Date de naissance constraint a voir avec jordan =============================
        ->add('date_de_naissance', DateType::class, [
            'label' => 'Date de naissance',
            'constraints' => [
                new NotBlank(),
            ]
        ])
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
                        'min' => 4
                    ])
                ]
            ])
            // ->add('check_password', PasswordType::class, [
            //     'label' => 'Confirmation du Mot de Passe',
            //     'constraints' => [
            //         new EqualTo([
            //             'propertyPath' => 'password'
            //         ])
            //     ]
            // ])
            ->add('numen', IntegerType::class,[
                'label' => 'Veuillez indiquer votre NUMEN en tant que membre du corps enseignant'
                ])

            ->add('submit', SubmitType::class, [
                'label' => 'Créer un compte'
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $user = new User();
            
            $formData = $form->getData();

            $encodedPassword = $encoder->encodePassword($user, $formData['password']);
            
            $user->setPassword($encodedPassword);
            $user->setPseudo($formData['pseudo']);
            $user->setEmail($formData['email']);
            $user->setNumen($formData['numen']);
            $user->setNom($formData['nom']);
            $user->setPrenom($formData['prenom']);
            $user->setDateDeNaissance($formData['date_de_naissance']);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('homepage');
        } else {
            return $this->render('security/register.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

}
