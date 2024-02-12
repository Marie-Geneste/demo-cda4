<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function new(): Response {

        $produit = new Produit();

        $form = $this-> createForm(ProduitType::class, $produit);

        return $this->render('produit/new.html.twig', [
            'form' => $form
        ]);
    }
}
