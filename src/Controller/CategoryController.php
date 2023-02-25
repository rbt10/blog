<?php

namespace App\Controller;

use App\Entity\Post\Category;
use App\Repository\Post\PostsRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category/{slug}', name: 'app_category')]
    public function index(Category $category): Response
    {

        $posts = $category->getPosts();
        return $this->render('category/index.html.twig', [
            'category'=> $category,
            'posts' => $posts
        ]);
    }
}
