<?php

namespace App\Controller;

use App\Entity\DofusRessource;
use App\Entity\Group;
use App\Entity\RessourceEntity;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;


class MainController extends AbstractController
{
    #[Route('/main', name: 'main')]
    public function index(): Response
    {


        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',

        ]);
    }

    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->redirectToRoute('show-ressources');
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

        //Get all users from Users_Group
        $entitiesFromGroup = $doctrine->getRepository(Group::class);

        // Fetch all common user in groups
        $userGroupId = [];

        $foundDataFromAllGroups = [];

        // If User is not connected
        if(!$this->getUser()){
            $ressources = $doctrine->getRepository(DofusRessource::class)->findAllNoUser();

        }
        else {

            $userGroup = $entitiesFromGroup->findAllCommonUserIds($this->getUser()->getId());
            //Foreach Group where user is
            foreach ($userGroup as $ug ){
                $user = $ug->getUsers();

                // Foreach users in thos groups
                foreach ($user as $u){
                    array_push($userGroupId,$u->getId());

                }
            }
            $userGroupId = array_unique($userGroupId);


            //Fetch all @RessourceEntity from all user in group
            $entitiesFromUser = $entitiesFromUser->findBy(array('user_id' => $userGroupId));


            // If no elements is found then ressources = All database
            if(!$entitiesFromUser){
                $ressources = $doctrine->getRepository(DofusRessource::class)->findAllNoUser();

            }
            else{
                // Create an array of dofus ressource

                foreach ($entitiesFromUser as $entity){

                    array_push($found_id, $entity->getRessourceId()->getId());
                }


                $found_id = array_unique($found_id);



                //Found object to parse in JSON for front
                $foundDataFromAllGroups = $doctrine->getRepository(RessourceEntity::class)->fetchObjectJoin($entitiesFromUser);

                $ressources = $doctrine->getRepository(DofusRessource::class)->findAllNotGiveByUser($found_id);

            }

        }







        return $this->render('main/ressource.html.twig', [
            'ressources' => $this->json($ressources),
            'ressource_found' => $foundDataFromAllGroups ? $this->json($foundDataFromAllGroups) : $this->json([]),

        ]);
    }

}
