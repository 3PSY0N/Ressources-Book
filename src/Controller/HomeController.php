<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public const MAX_PER_PAGE = 10;

    /**
     * @Route("/", name="app_home")
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function showHome(Request $request,ArticlesRepository $articlesRepository, PaginatorInterface $paginator): Response
    {
        $articlesRepo = $articlesRepository->findAll();
        $pagination = $paginator->paginate($articlesRepo, $request->query->get('page', 1), self::MAX_PER_PAGE);

        return $this->render('public/home.html.twig', [
            'articles' => $pagination
        ]);
    }

    /**
     * @param Request $request
     * @param ArticlesRepository $articlesRepository
     * @param PaginatorInterface $paginator
     * @return Response
     * @Route("/search", name="app_search", methods={"GET"})
     */
    public function search(Request $request, ArticlesRepository $articlesRepository, PaginatorInterface $paginator): Response
    {
        $filter = $request->get('filter');

        if (null === $filter || empty($filter)) {
            return $this->redirectToRoute('app_home');
        }

        $articlesSearch = $articlesRepository->search($filter);
        $pagination = $paginator->paginate($articlesSearch, $request->query->get('page', 1), self::MAX_PER_PAGE);

        return $this->render('public/home.html.twig', [
            'articles' => $pagination
        ]);
    }
}
