<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_produit')]
    public function index(ProduitRepository $produitRepository): Response
    {

        $produits= $produitRepository->findAll();
        //dd($produits);

        return $this->render('produit/index.html.twig', [
            //'controller_name' => 'ProduitController',
            'produits' => $produits,
        ]);
    }

    #[Route('/produit/new', name: 'app_produit_new')]
    public function new(Request $request, EntityManagerInterface $em): Response {

        $produit = new Produit();

        $form = $this-> createForm(ProduitType::class, $produit);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $produit = $form->getData();
            $em->persist($produit);
            $em->flush();
            //dd($produit);
            return $this->redirectToRoute('app_produit');
        }

        return $this->render('produit/new.html.twig', [
            'form' => $form
        ]);
    }
}
