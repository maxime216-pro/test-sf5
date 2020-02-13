<?php

namespace App\EventSubscriber;

use App\Repository\ConferenceRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{

    private $twig;
    private $conferenceRepo;

    public function __construct(Environment $twig, ConferenceRepository $conferenceRepo)
    {
        $this->twig = $twig;
        $this->conferenceRepo = $conferenceRepo;
    }

    public function onControllerEvent(ControllerEvent $event)
    {
        $this->twig->addGlobal('conferences', $this->conferenceRepo->findAll());
    }

    public static function getSubscribedEvents()
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}
