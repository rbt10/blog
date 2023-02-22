<?php

namespace App\DataFixtures;


use App\Entity\Post\Category;
use App\Repository\Post\PostsRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoryFixtures extends Fixture
{
    private $slugger;

    /**
     * @param SluggerInterface $slugger
     */
    public function __construct(private PostsRepository $postsRepository, SluggerInterface $slugger){
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Faker\Factory::create();

        $categories= [];
        for ($i =0; $i <50; $i++){
            $categorie = new Category();
            $categorie->setName($faker->word(1, true) . ''. $i)
                ->setDescription(  $faker->realText(254))
                ->setSlug($this->slugger->slug($categorie->getName()));

            $manager->persist($categorie);
            $categories[] = $categorie;
        }

        $posts = $this->postsRepository->findAll();

        foreach ($posts as $post){
            for ($i=0; $i< mt_rand(1,5); $i++){
                $post->addCategory($categories[mt_rand(0,count($categories) -1)]);
            }

        }

        $manager->flush();
    }
}
