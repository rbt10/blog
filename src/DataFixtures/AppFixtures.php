<?php

namespace App\DataFixtures;

use App\Entity\Post\Posts;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{
    private $slugger;

    /**
     * @param SluggerInterface $slugger
     */
    public function __construct(SluggerInterface $slugger){
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Faker\Factory::create();
        for ($i =0; $i <50; $i++){
            $post = new Posts();
            $post->setTitle($faker->word(4, true))
                ->setContent($faker->realText(1800))
                ->setSlug($this->slugger->slug($post->getTitle()))
                ->setState(mt_rand(0,2)=== 1 ? Posts::STATE[0] : Posts::STATE[1]);


            $manager->persist($post);
        }

        $manager->flush();
    }
}
