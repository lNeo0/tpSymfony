<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TpController extends AbstractController
{
    /**
     * @Route("/tp", name="tp")
     */
    public function index(): Response
    {
        return $this->render('tp/index.html.twig', [
            'controller_name' => 'ControllerTP',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(){
        return $this->render('tp/home.html.twig');
    }
}
