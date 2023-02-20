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


class ListProprietaireController extends AbstractController
{
    #[Route('/list/proprietaire', name: 'app_list_proprietaire')]
    public function index(UserRepository $prp): Response
    {
        $proprietaires = $prp->findAll();
        return $this->render('list_proprietaire/index.html.twig', [
            "propritaires"=>$proprietaires
        ]);
    }

    #[Route("/delete_proprietaire/{id}", name:'delete_proprietaire')]
    public function delete($id, ManagerRegistry $doctrine)
    {$c = $doctrine
        ->getRepository(User::class)
        ->find($id);
        $em = $doctrine->getManager();
        $em->remove($c);
        $em->flush() ;
        return $this->redirectToRoute('app_list_proprietaire');
    }

    #[Route('/bloquer_proprietaire/{id}', name: 'bloquer_proprietaire')]
    public function  update(ManagerRegistry $doctrine,$id,  Request  $request) : Response
    { $user = $doctrine
        ->getRepository(User::class)
        ->find($id);
        $user->setBloque(1);

         $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('app_list_proprietaire');
        
    }
}
