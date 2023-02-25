<?php

namespace App\Controller;

use App\Entity\Post\Posts;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LikeController extends AbstractController
{
    #[Route('/like/posts/{id}', name: 'app_like')]
    public function index(Posts $posts): Response
    {
        $user = $this->getUser();
        return $this->render('like/index.html.twig', [
            'controller_name' => 'LikeController',
        ]);
    }
}
