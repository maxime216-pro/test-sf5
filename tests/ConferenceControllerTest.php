<?php

namespace App\Tests;

use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Panther\PantherTestCase;

class ConferenceControllerTest extends PantherTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Give your feedback');
    }

    public function testCommentSubmission()
    {
        $client = static::createClient();
        $client->request('GET', '/conference/lyon0-2020');
        $client->submitForm('Submit', [
            'comment_form[author]' => 'Jean',
            'comment_form[text]' => 'Some feedback from an automated test.',
            'comment_form[email]' => $email = 'me@automated.mail',
            'comment_form[photo]' => dirname(__DIR__, 2).'/public/images/under-construction.gif',
        ]);

        $this->assertResponseRedirects();

        // Simulate comment validation
        $comment = self::$container->get(CommentRepository::class)->findOneByEmail($email);
        $comment->setState('published');
        self::$container->get(EntityManagerInterface::class)->flush();

        $client->followRedirect();
        $this->assertSelectorExists('div:contains("There are 5 comments.")');
    }

    public function testConferencePage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertCount(3, $crawler->filter('h4'));

        $client->clickLink('View');

        $this->assertPageTitleContains('L');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Lyon0 2020');
        $this->assertSelectorExists('div:contains("There are 4 comments.")');
    }
}
