<?php

namespace App\Controller;

use App\Entity\DofusRessource;
use App\Entity\RessourceEntity;
use App\Form\DofusRessourceEntityFormType;
use App\Form\RessourceEntityFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
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

        // Check if user already register this RessourceEntity();



        if($ressourceEntityRepository->getLastestElement($id,$requestUserId)){

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


            $entityManager->persist($ressourceEntity);
            $entityManager->flush();
            return $this->redirect("/show");
        }


        return $this->render('submit_ressource_entity/index.html.twig', [

            'form' => $form->createView(),
            'ressource_name'=>$ressource->getName(),

        ]);
    }

}
