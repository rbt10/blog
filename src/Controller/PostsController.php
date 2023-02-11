<?php

namespace App\Controller;

use App\Repository\Post\PostsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostsController extends AbstractController
{

    #[Route('/', name: 'app_posts', methods: ['GET'])]
    public function index(PostsRepository $postsRepository): Response
    {
        $posts = $postsRepository->findPublished();

        return $this->render('posts/index.html.twig',[
            'posts'=>$posts
        ]);
    }
}
