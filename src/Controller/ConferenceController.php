<?php

namespace App\Controller;

use App\Entity\Conference;
use App\Repository\CommentRepository;
use App\Repository\ConferenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ConferenceController extends AbstractController
{
    /**
     * @Route("/conference", name="homepage")
     */
    public function index(Environment $twig, ConferenceRepository $conferenceRepo)
    {
        return new Response($twig->render('conference/index.html.twig', [
            'conferences' => $conferenceRepo->findAll(),
        ]));
    }

    /**
     * @Route("/conference/{id}", name="conference")
     */
    public function show(Environment $twig, Conference $conference,
CommentRepository $commentRepo)
    {
        return new Response($twig->render('conference/show.html.twig', [
            'conference' => $conference,
            'comments' => $commentRepo->findBy(['conference' => $conference], ['createdAt' => 'DESC'])
        ]));
    }
}
