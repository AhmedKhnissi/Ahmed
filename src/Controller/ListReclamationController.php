<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListReclamationController extends AbstractController
{
    #[Route('/list/reclamation', name: 'app_list_reclamation')]
    public function index(): Response
    {
        return $this->render('list_reclamation/index.html.twig', [
            'controller_name' => 'ListReclamationController',
        ]);
    }
}
