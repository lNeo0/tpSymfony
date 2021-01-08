<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Articles;
use App\Entity\Categorie;

class TpController extends AbstractController
{
    /**
     * @Route("/tp", name="tp")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);

        $articles = $repo->findAll();

        return $this->render('tp/index.html.twig', [
            'controller_name' => 'ControllerTP',
            'articles' => $articles
        ]);
    }


    /**
     * @Route("/", name="home")
     */
    public function home(){
        return $this->render('tp/home.html.twig');
    }


        /**
     * @Route("/tp/new", name="article_create")
     * @Route("/tp/{id}/modif", name="tp_modif")
     */
    public function gestionArticles(Articles $article = null, Request $request, EntityManagerInterface $manager) {

        if(!$article){
            $article = new Articles();
        }
        
        $form = $this->createFormBuilder($article)
                    ->add('titre', TextType::class, [
                        'attr' => [
                            'placeholder' => "Titre de l'article",
                            'class' => 'form-control'
                        ]
                    ])
                    ->add('categorie', EntityType::class,[
                        'class' => Categorie::class,
                        'choice_label' => 'titre',
                    ])
                    ->add('contenu', TextareaType::class, [
                        'attr' => [
                            'placeholder' => "Contenu de l'article",
                            'class' => 'form-control'
                        ],
                    ])
                    ->add('image', TextType::class, [
                        'attr' => [
                            'placeholder' => "Url de l'image",
                            'class' => 'form-control'
                        ]
                    ])
                    ->add('extraitContenu', TextType::class, [
                        'attr' => [
                            'placeholder' => "Introduction de l'article",
                            'class' => 'form-control'
                        ]
                    ])
                    ->getForm();
                
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            if(!$article->getId()){
                $article->setDateCreation(new \DateTime());
            }
            
            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('tp_show', ['id' => $article->getId()]);
        }

        return $this->render('tp/create.html.twig', [
            'formArticles' => $form->createView(),
            'editMode' => $article->getId()!== null
        ]);
    }


    /**
     * @Route("/tp/{id}", name="tp_show")
     */
        public function show($id){
            $repo = $this->getDoctrine()->getRepository(Articles::class);

            $article = $repo->find($id);

            return $this->render('tp/show.html.twig', [
                'article' => $article
            ]);
        }
}

