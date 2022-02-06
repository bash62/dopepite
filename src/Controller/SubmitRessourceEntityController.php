<?php

namespace App\Controller;

use App\Entity\DofusRessource;
use App\Entity\RessourceEntity;
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

    #[Route('/ressource/add/{id}', name: 'sumbit_ressource_form')]
    public function addNewRessourceEntityForm(int $id,ManagerRegistry $doctrine,Request $request,EntityManagerInterface $entityManager): Response
    {
        $ressourceEntity = new RessourceEntity();

        $ressource = $doctrine->getRepository(DofusRessource::class)->find($id);
        $ressourceEntity->setRessourceId($ressource);
        $ressourceEntity->setUserId($this->getUser());

        $form = $this->createForm(RessourceEntityFormType::class,$ressourceEntity);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($ressourceEntity);
            $entityManager->flush();
            return $this->redirect("/show");
        }


        return $this->render('submit_ressource_entity/index.html.twig', [

            'form' => $form->createView(),

        ]);
    }

}
