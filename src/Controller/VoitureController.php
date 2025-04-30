<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureFormType;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VoitureController extends AbstractController
{
    public function __construct(
        private VoitureRepository $voitureRepository,
        private EntityManagerInterface $entityManager
    ) 
    {
    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $voitures = $this->voitureRepository->findAll();

        return $this->render('voiture/index.html.twig', [
            'controller_name' => 'MainController',
            'voitures' => $voitures
        ]);
    }
  
    #[Route('/voiture/{id}/supprimer', name: 'car_remove')]
    public function removeCar(int $id): Response
    {

        $voiture = $this->voitureRepository->find($id);

        if(!$voiture){
            return $this->redirectToRoute('home');
        }

        $this->entityManager->remove($voiture);
        $this->entityManager->flush();

        return $this->redirectToRoute('home');
    }

    #[Route('/voiture/ajouter', name: 'car_add')]
    public function addCar(Request $request): Response
    {   
        $voiture = new Voiture;
        
        $form = $this->createForm(VoitureFormType::class,$voiture);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $voiture = $form->getData();
            $this->entityManager->persist($voiture);
            $this->entityManager->flush();

            return $this->redirectToRoute('car',['id' => $voiture->getId()]);
        }

        return $this->render('voiture/nouvelleVoiture.html.twig', [
            'form' => $form,
        ]);
    }
    
    #[Route('/voiture/{id}', name: 'car')]
    public function showDetail(int $id): Response
    {

        $voiture = $this->voitureRepository->find($id);

        if(!$voiture){
            return $this->redirectToRoute('home');
        }

        return $this->render('voiture/voiture.html.twig', [
            'voiture' => $voiture,
        ]);
    }
}
