<?php

namespace App\Controller;

use App\Entity\DofusRessource;
use App\Entity\Group;
use App\Entity\RessourceEntity;
use App\Form\DofusRessourceEntityFormType;
use App\Form\RessourceEntityFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Boolean;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubmitRessourceEntityController extends AbstractController
{
    #[Route('/submit/ressource/entity', name: 'submit_ressource_entity')]
    public function index(): Response
    {
        return $this->render('submit_ressource_entity/index.html.twig', [
            'controller_name' => 'SubmitRessourceEntityController',
        ]);
    }

    #[Route('/ressource/archive/{id}', name: 'archiver-ressource')]
    public function archiveRessource(int $id,ManagerRegistry $doctrine,Request $request): Response
    {

        $message = "L'objet $id est bien archivé.";
        $entityManager = $doctrine->getManager();
        $ressource = $doctrine->getRepository(DofusRessource::class)->find($id);


        if(!$ressource){
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $ressource->setAvailable(false);
        $entityManager->flush();

        return $this->redirectToRoute('show-ressources');


    }

    #[Route('/ressource/new/', name: 'new_ressource')]
    public function new(ManagerRegistry $doctrine,Request $request,EntityManagerInterface $entityManager) : Response
    {
        $ressourceEntity = new DofusRessource();
        $ressourceEntity->setAnkamaId(0);

        $form = $this->createForm(DofusRessourceEntityFormType::class,$ressourceEntity);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $name = $form->getData()->getName();
            $level = $form->getData()->getLevel();
            $type = $form->getData()->getType();
            $imgUrl = $form->getData()->getImgUrl();
            $url = $form->getData()->getUrl();
            $description = $form ->getData()->getDescription();

            $entityManager->persist($ressourceEntity);
            $entityManager->flush();
            return $this->redirect("/show");

        }

        return $this->render('submit_ressource_entity/new.html.twig', [
            'form'=>$form->createView(),
        ]);
    }

    // TODO : Add Ressource owned by user_group

    #[Route('/ressource/add/{id}', name: 'sumbit_ressource_form')]
    public function addNewRessourceEntityForm(int $id,ManagerRegistry $doctrine,Request $request,EntityManagerInterface $entityManager): Response
    {

        $requestUserId = $this->getUser();
        $ressourceEntity = new RessourceEntity();
        $ressource = $doctrine->getRepository(DofusRessource::class);

        $ressourceEntityRepository = $doctrine->getRepository(RessourceEntity::class);

        //Check if entity exist

        if(!$ressource->find($id)){
            return $this->redirectToRoute('show-ressources');


        }
        // Check if user or member of group already register this RessourceEntity();



        if($this->isAlreadyInDb($doctrine,$ressource->find($id)->getId())){

             return $this->redirectToRoute('show-ressources');
        }


        $ressource = $ressource->find($id);
        $ressourceEntity->setRessourceId($ressource);
        $ressourceEntity->setUserId($requestUserId);

        $form = $this->createForm(RessourceEntityFormType::class,$ressourceEntity);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $bonus = $form->getData()->getBonus();
            $pepite = $form->getData()->getCoeffPepite();

            if($bonus > 0){
                $ressourceEntity->setCoeffPepiteByBonus($pepite,$bonus);
            }
            else{
                $ressourceEntity->setCoeffPepite($pepite*2);
            }


            $entityManager->persist($ressourceEntity);
            $entityManager->flush();
            return $this->redirect("/show");
        }


        return $this->render('submit_ressource_entity/index.html.twig', [

            'form' => $form->createView(),
            'ressource_name'=>$ressource->getName(),

        ]);
    }


    /**
     * Check if the id of the ressource is already given by another user
     * @param ManagerRegistry $doctrine
     * @param int $id The id of the ressource
     * @return bool
     */
    public function isAlreadyInDb(ManagerRegistry $doctrine,int $id) : bool {

        $found_id = [];

        // RessourceEntity
        $entitiesFromUser = $doctrine->getRepository(RessourceEntity::class);

        //Get all users from Users_Group
        $entitiesFromGroup = $doctrine->getRepository(Group::class);

        // Fetch all common user in groups
        $userGroupId = [];



        $userGroup = $entitiesFromGroup->findAllCommonUserIds($this->getUser()->getId());
        //Foreach Group where user is
        foreach ($userGroup as $ug ){
            $user = $ug->getUsers();
            // Foreach users in thos groups
            foreach ($user as $u){
                array_push($userGroupId,$u->getId());

            }
        }

        //Fetch all $ids from all user in group
        $entitiesFromUser = $entitiesFromUser->findBy(array('user_id' => array_unique($userGroupId)));


        // Create an array of entities
        foreach ($entitiesFromUser as $entity){

            array_push($found_id, $entity->getRessourceId()->getId());
        }

        $found_id = array_unique($found_id);
        return in_array($id,$found_id);




    }



}
