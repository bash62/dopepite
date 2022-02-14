<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\RessourceEntity;

class StatsController extends AbstractController
{
    #[Route('/stats', name: 'landing-stats')]
    public function index(ManagerRegistry $doctrine): Response
    {

        $reRep = $doctrine->getRepository(RessourceEntity::class);

        $reRep = $reRep->fetchAll();
        dump($reRep);
        return $this->render('stats/index.html.twig', [
            'ressources' => $reRep,
        ]);
    }
}
