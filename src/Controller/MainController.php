<?php

namespace App\Controller;

use App\Entity\DofusRessource;
use App\Entity\RessourceEntity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

class MainController extends AbstractController
{
    #[Route('/main', name: 'main')]
    public function index(): Response
    {


        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',

        ]);
    }

    #[Route('/show', name: 'show-ressources')]
    public function show(ManagerRegistry $doctrine) : Response
    {
        $entitiesFromUser = $doctrine->getRepository(RessourceEntity::class)->findAll();

        $ressources = $doctrine->getRepository(DofusRessource::class)->findAllNotGiveByUser();
        return $this->render('main/ressource.html.twig', [
            'ressources' => $this->json($ressources)
        ]);
    }
}
