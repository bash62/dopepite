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

    /**
     * @param ManagerRegistry $doctrine
     * @return Response
     * Show all ressources not given by user or user group
     */
    #[Route('/show', name: 'show-ressources')]
    public function show(ManagerRegistry $doctrine) : Response
    {
        $found_id = [];

        // RessourceEntity
        $entitiesFromUser = $doctrine->getRepository(RessourceEntity::class);


        // Fetch all User RessourceEntity if user is connected
        if(!$this->getUser() || !$entitiesFromUser->findBy(array('user_id' => $this->getUser()->getId()))){
            $ressources = $doctrine->getRepository(DofusRessource::class)->findAllNoUser();

        }
        else {
            $entitiesFromUser = $entitiesFromUser->findBy(array('user_id' => $this->getUser()->getId()));
            foreach ($entitiesFromUser as $entity){

                array_push($found_id, $entity->getRessourceId()->getId());
            }
            $ressources = $doctrine->getRepository(DofusRessource::class)->findAllNotGiveByUser($found_id);

        }




        // Fetch all Ressources not in $entitiesFromuser



        return $this->render('main/ressource.html.twig', [
            'ressources' => $this->json($ressources)
        ]);
    }
}
