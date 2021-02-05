<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        
        $faker = \Faker\Factory::create('fr_FR');
        
        
        $user = new User();
        $user->setPseudo($faker->name())
             ->setEmail($faker->email())
             ->setPassword($faker->password(10))
             ->setAvatar('https://picsum.photos/id/' . $faker->numberBetween(1, 1050) . '/200/320')
             ->setBirthday(new \DateTime())
             ->setFirstname($faker->name())
             ->setLastname($faker->name())
             ->setRoles(['ROLE_USER'])
             ->setCreatedAt(new \DateTime())
             ->setValid(1);
             
        $manager->persist($user);
            
        
        
        for($i = 1; $i < 11; $i++)
        {
            $category = new Category();
            $category->setTitle($faker->realText(20))
                     ->setDescription($faker->realText(80))
                     ->setPicture('https://picsum.photos/id/' . $faker->numberBetween(1, 1050) . '/1920/1080')
                     ->setValid(1);
                    
            $manager->persist($category);
            
            for($i = 1; $i < 11; $i++)
            {
                $article = new Article();
                $article->setTitle($faker->realText(20))
                        ->setContent($faker->realText(200))
                        ->setPicture('https://picsum.photos/id/' . $faker->numberBetween(1, 1050) . '/1920/1080')
                        ->setCreatedAt(new \DateTime())
                        ->setPublishedAt(new \DateTime())
                        ->setValid(1)
                        ->setUser($user)
                        ->setCategory($category);
                        
                $manager->persist($article);
            }
            
            for($i = 1; $i < 11; $i++)
            {
                $comment = new Comment();
                $comment->setPseudo($faker->name(45))
                        ->setEmail($faker->realText(45))
                        ->setContent($faker->realText(200))
                        ->setCreatedAt(new \DateTime())
                        ->setValid(1)
                        ->setArticle($article);
                        
                $manager->persist($comment);
            }
        }

        $manager->flush();
    }
}