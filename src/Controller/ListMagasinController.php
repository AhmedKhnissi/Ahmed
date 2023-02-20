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

class ListMagasinController extends AbstractController
{
    #[Route('/list/magasin', name: 'app_list_magasin')]
    public function index(UserRepository $mag): Response
    {
        $magasins = $mag->findAll();
        return $this->render('list_magasin/index.html.twig', [
            "magasins"=>$magasins
        ]);
    }

    #[Route("/delete/{id}", name:'delete_magasin')]
    public function delete($id, ManagerRegistry $doctrine)
    {$c = $doctrine
        ->getRepository(User::class)
        ->find($id);
        $em = $doctrine->getManager();
        $em->remove($c);
        $em->flush() ;
        return $this->redirectToRoute('app_list_magasin');
    }

    #[Route('/bloquer_magasin/{id}', name: 'bloquer_magasin')]
    public function  update(ManagerRegistry $doctrine,$id,  Request  $request) : Response
    { $user = $doctrine
        ->getRepository(User::class)
        ->find($id);
        $user->setBloque(1);

         $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('app_list_magasin');
        
    }
}
