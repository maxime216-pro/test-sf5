<?php

namespace App\DataFixtures;

use App\Entity\Conference as EntityConference;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Conference extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 3; ++$i) {
            $conference = new EntityConference();
            $conference->setCity("Lyon$i");
            $conference->setYear(2020);
            $conference->setIsInternational($i%2 === 0 ? true : false);
            $this->addReference("conf$i", $conference);

            $manager->persist($conference);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
