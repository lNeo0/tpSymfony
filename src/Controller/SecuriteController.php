<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecuriteController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder){
        $user = new Utilisateurs();

        $form =$this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('securite_login');
        }

        return $this->render('securite/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/connexion", name="securite_login")
     */
    public function login(){
        return $this->render('securite/login.html.twig');
    }

    /**
     * @Route("/deconnexion", name="securite_logout")
     */
    public function logout() {}
}
