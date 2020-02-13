<?php

namespace App\DataFixtures;

use App\Entity\Comment as EntityComment;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Comment extends Fixture  implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; ++$i) {
            $comment = new EntityComment();
            $comment->setAuthor("author$i");
            $comment->setText("commentaire numero $i");
            $comment->setEmail("emaildutype$i@gmail.com");
            if ($i < 4) {
                $comment->setConference($this->getReference('conf0'));
            } elseif ($i <10) {
                $comment->setConference($this->getReference('conf1'));
            } else {
                $comment->setConference($this->getReference('conf2'));
            }
            $manager->persist($comment);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return array(
            Conference::class
        );
    }

    public function getOrder(): int
    {
        return 2;
    }
}
