<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use  Doctrine\Persistence\ManagerRegistry;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class ListDemandeAccesController extends AbstractController
{
    #[Route('/list/demande_acces', name: 'app_list_demande_acces')]
    public function index(UserRepository $da): Response
    {
        $demandes = $da->findByBloque(1);
        return $this->render('list_demande_acces/index.html.twig', [
            "demandes"=>$demandes
        ]);
    }

    #[Route('/accepter/{id}', name: 'accepter')]
    public function  update(ManagerRegistry $doctrine,$id,  Request  $request) : Response
    { $user = $doctrine
        ->getRepository(User::class)
        ->find($id);
        $user->setBloque(0);

         $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('app_list_demande_acces');
        
    }
}
