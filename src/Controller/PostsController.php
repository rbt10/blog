<?php

namespace App\Controller;

use App\Entity\Post\Posts;
use App\Form\SearchType;
use App\Model\SearchData;
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
        $search = new SearchData();
        $form = $this->createForm(SearchType::class, $search);

        $form->handleRequest($request);

        if(  $form->isSubmitted() && $form->isValid()){
            $search->page = $request->query->getInt('page',1);
            $posts = $postsRepository->findBySearched($search);
            return $this->render('posts/index.html.twig',[
                'form'=>$form->createView(),
                'posts'=>$posts

            ]);
        }
        $posts = $postsRepository->findPublished( $request->query->getInt('page',1));

        return $this->render('posts/index.html.twig',[
            'posts'=>$posts,
            'form'=>$form->createView()
        ]);
    }

    #[Route('/article/{slug}',name: 'app_show', methods: ['GET'])]
    public function show( Posts $post, PostsRepository $repository) : Response{


        return $this->render('posts/show.html.twig',[
            'post'=>$post
        ]);
    }
}
