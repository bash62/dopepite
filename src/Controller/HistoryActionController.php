<?php

namespace App\Controller;

use App\Entity\DofusRessource;
use App\Entity\RessourceEntity;
use App\Form\RessourceEntityFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistoryActionController extends AbstractController


{
    #[Route('/history/action', name: 'history_action')]
    public function index(ManagerRegistry $doctrine): Response
    {

        $ressourcePostByUser = $doctrine->getRepository(RessourceEntity::class)->findLastActionFromUser($this->getUser()->getId(),10) ;

        return $this->render('history_action/index.html.twig', [
            'last_action' => $this->json($ressourcePostByUser),
        ]);
    }

    #[Route('/history/update/{id}', name: 'update_ressource_from_history_form')]
    public function updateRessourceFromHistory(int $id,ManagerRegistry $doctrine,Request $request,EntityManagerInterface $entityManager): Response
    {

        $requestUserId = $this->getUser();
        $ressourceEntity = new RessourceEntity();

        $ressourceEntityRepository = $doctrine->getRepository(RessourceEntity::class)->find($id);

        //Check if entity exist

        if(!$ressourceEntityRepository){
            return $this->redirectToRoute('history_action');

        }

        $DofusRessource = $doctrine->getRepository(DofusRessource::class)->find($ressourceEntityRepository->getRessourceId());

        if(!$DofusRessource){
            return $this->redirectToRoute('history_action');

        }

        if($ressourceEntityRepository->getUserId() != $this->getUser()){
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }



        $form = $this->createForm(RessourceEntityFormType::class,$ressourceEntityRepository);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $bonus = $form->getData()->getBonus();
            $pepite = $form->getData()->getCoeffPepite();

            if($bonus > 0) {

                $ressourceEntityRepository->setCoeffPepiteByBonus($pepite, $bonus);
            }

            $entityManager->flush();

            return $this->redirectToRoute('history_action');
        }


        return $this->render('submit_ressource_entity/update.html.twig', [

            'form' => $form->createView(),
            'name'=> $DofusRessource->getName(),

        ]);
    }



    #[Route('/history/revert/{id}', name: 'revert_action')]
    public function revertAction(int $id,ManagerRegistry $doctrine): Response
    {

        $entityManager = $doctrine->getManager();
        $ressource = $doctrine->getRepository(RessourceEntity::class)->find($id);


        if(!$ressource){
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        if($ressource->getUserId() != $this->getUser()){
            throw $this->createNotFoundException(
                'User ID does not match with resource_id'
            );
        }

        $entityManager->remove($ressource);
        $entityManager->flush();

        return $this->redirectToRoute('history_action');


    }
}
