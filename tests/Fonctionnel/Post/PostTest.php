<?php

namespace App\Tests\Fonctionnel\Post;

use App\Entity\Post\Posts;
use App\Repository\Post\PostsRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Doctrine\ORM\EntityManagerInterface;

class PostTest extends WebTestCase
{
    public function testPostWorks(): void
    {
        $client = static::createClient();

        /** @var UrlGeneratorInterface  */
        $urlGeneratorInterface = $client->getContainer()->get('router');

        /** @var EntityManagerInterface */
        $entityManager =  $client->getContainer()->get('doctrine.orm.entity_manager');

        /** @var PostsRepository */

        $postRepository = $entityManager->getRepository(Posts::class);

        /** @var Posts */

        $post = $postRepository->findOneBy([]);

        $client->request(
            Request::METHOD_GET,
            $urlGeneratorInterface->generate('app_show',['slug' => $post->getSlug()]));

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', ucfirst($post->getTitle()));
    }
}
