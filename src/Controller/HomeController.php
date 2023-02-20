<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/veterinaire', name: 'veterinaire')]
    public function index_v(): Response
    {
        return $this->render('base_veterinaire.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/proprietaire', name: 'propritaire')]
    public function index_p(): Response
    {
        return $this->render('base_proprietaire.html.twig');
    }



    #[Route('/magasin', name: 'magasin')]
    public function index_m(): Response
    {
        return $this->render('base_magasin.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('base_home.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
