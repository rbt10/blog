<?php

namespace App\EventSubscriber;
use App\Repository\Post\CategoryRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class dropdownCategory implements EventSubscriberInterface{

    const ROUTES = ['app_posts', 'app_category','app_show'];

    public function __construct(private CategoryRepository $category, private Environment $twig)
    {

    }


    public function InjectGlobalVariable(RequestEvent $event){

        $route = $event->getRequest()->get('_route');
        if(in_array($route, dropdownCategory::ROUTES)){
            $categories = $this->category->findAll();
            $this->twig->addGlobal('allCategories', $categories);
        }


    }

    public  static function  getSubscribedEvents(){
        return [KernelEvents::REQUEST=>'InjectGlobalVariable'];
    }
}
