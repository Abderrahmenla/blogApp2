<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $blogPost = new BlogPost();
        $blogPost->setTitle('A third post');
        $blogPost->setPublished(new \DateTime('2021-08-20 12:00:00'));
        $blogPost->setContent('Post text/Content');
        $blogPost->setAuthor('Abderrahmen Lahmedi');
        $blogPost->setSlug('a-third-post');
        $manager->persist($blogPost);

        $blogPost = new BlogPost();
        $blogPost->setTitle('A fourth post');
        $blogPost->setPublished(new \DateTime('2021-08-22 12:00:00'));
        $blogPost->setContent('Post text/Content');
        $blogPost->setAuthor('Abderrahmen Lahmedi');
        $blogPost->setSlug('a-fourth-post');
        $manager->persist($blogPost);

        $manager->flush();
    }
}