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

class ListVeterinaireController extends AbstractController
{
    #[Route('/list/veterinaire', name: 'app_list_veterinaire')]
    public function index(UserRepository $vet): Response
    {
        //$role='ROLE_VETERINAIRE';
        //$veterinaires = $vet->findByRoles($role);
        $veterinaires = $vet->findAll();

        return $this->render('list_veterinaire/index.html.twig', [
           "veterinaires"=>$veterinaires
        ]);
    }


    #[Route("/delete_veterinaire/{id}", name:'delete_veterinaire')]
    public function delete($id, ManagerRegistry $doctrine)
    {$c = $doctrine
        ->getRepository(User::class)
        ->find($id);
        $em = $doctrine->getManager();
        $em->remove($c);
        $em->flush() ;
        return $this->redirectToRoute('app_list_veterinaire');
    }


    #[Route('/bloquer_veterinaire/{id}', name: 'bloquer_veterinaire')]
    public function  update(ManagerRegistry $doctrine,$id,  Request  $request) : Response
    { $user = $doctrine
        ->getRepository(User::class)
        ->find($id);
        $user->setBloque(1);

         $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('app_list_veterinaire');
        
       


    }
}
