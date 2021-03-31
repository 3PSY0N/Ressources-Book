<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     * @return Response
     */
    public function showHome(): Response
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

        return $this->render('public/home.html.twig', [
            'articles' => $articles
        ]);
    }
}
