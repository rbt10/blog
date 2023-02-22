<?php

namespace App\Controller;

use App\Entity\Post\Posts;
use App\Repository\Post\PostsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostsController extends AbstractController
{

    #[Route('/', name: 'app_posts', methods: ['GET'])]
    public function index(PostsRepository $postsRepository, PaginatorInterface $paginator,Request $request): Response
    {
        $posts = $postsRepository->findPublished( $request->query->getInt('page',1));



        return $this->render('posts/index.html.twig',[
            'posts'=>$posts
        ]);
    }

    #[Route('/article/{slug}',name: 'app_show', methods: ['GET'])]
    public function show( Posts $post, PostsRepository $repository) : Response{


        return $this->render('posts/show.html.twig',[
            'post'=>$post
        ]);
    }
}
