<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 26/11/18
 * Time: 14:39
 */




namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;



class TagFixtures extends Fixture
{
    private $tags = [
        'Nouveautés',
        'Risques',
        'Securité',
        'Emploi',
        'Formation'
    ];

    public function load (ObjectManager $manager)
    {

        foreach ($this->tags as $key => $tagName) {
            $tag = new Tag();
            $tag->setName($tagName);
            $manager->persist($tag);
            $this->addReference('tag' . $key, $tag);
        }
        $manager->flush();

    }
}

