<?php

namespace App\Controller;

use App\Entity\RendezVous;
use App\Entity\User;
use App\Entity\Veterinaire;
use App\Form\RdvType;
use App\Repository\AnimalRepository;
use App\Repository\RapportMedicalRepository;
use App\Repository\RendezVousRepository;
use App\Repository\VeterinaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PRDVController extends AbstractController
{


    #[Route('/form/{id_veterinaire}', name: 'form')]
    public function Affiche($id_veterinaire,\Symfony\Component\HttpFoundation\Request $request): Response {
        $idVeterinaire = $id_veterinaire;
        $em=$this->getDoctrine()->getManager();
        $veterinaire = $em->getRepository(Veterinaire::class)->find($idVeterinaire);
        $rendezVous=new RendezVous();
        $form=$this->createForm(RdvType::class,$rendezVous, [
            'veterinaire' => $veterinaire
        ]);
        $form->add('Valider',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($rendezVous);
            $em->flush();
            return $this->redirectToRoute('rdverified');
        }
        return $this->renderForm('prdv/form.html.twig',[
            'formulaire'=>$form
        ]);}

    #[Route('/update/{id}', name: 'update')]
    public function Update($id, RendezVousRepository $repo,\Symfony\Component\HttpFoundation\Request $request): Response {
        $rdv=$repo->find($id);
        $formulaire=$this->createForm(RdvType::class,$rdv);
        $formulaire->add('Update',SubmitType::class);
        $formulaire->handleRequest($request);
        if($formulaire->isSubmitted() && $formulaire->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return  $this->redirectToRoute('rdverified');
        }
        return $this->render('prdv/form.html.twig', [
            'formulaire'=>$formulaire->createView()
        ]);
    }

    #[Route('/rdv', name: 'rdv')] // c'est pour prendre toutes mes rdv
    public function index_rdv(VeterinaireRepository $repository): Response
    {
        $veto=$repository->findAll();
        return $this->render('/prdv/index.html.twig',['veto'=>$veto]);
    }

    #[Route('/mrdv', name: 'mrdv')] //c'est pour consulter les rendez-vous
    public function index_mrdv(VeterinaireRepository $Repository): Response{
        $veto=$Repository->findAll();
        return $this->render('prdv/mrdv.html.twig', [
            'veto'=>$veto
        ]);}




    #[Route('/rdverified', name: 'rdverified')] // c'est la page de validation de rendez-vous
    public function index_rdverified(): Response
    {
        return $this->render('/prdv/rdverified.html.twig');
    }

    #[Route('/delete/{id}', name: 'sup')]
    public function Delete($id,RendezVousRepository $repo): Response {
        $rendv=$repo->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($rendv);
        $em->flush();
        return  $this->redirectToRoute('rdv');
    }
    #[Route('/lanim', name: 'lanim')] //c'est pour toutes lister les animaux et puis vers "crm"
    public function index_lanim(AnimalRepository $repository): Response
    {
        $animal=$repository->findAll();
        return $this->render('prdv/lanim.html.twig',['animal'=>$animal]);
    }

    #[Route('/crm/{id_Animal}', name: 'crm')] //c'est pour lister le rm mentionée par "lanim"
    public function index_($id_Animal, AnimalRepository $animalRepository): Response
    {
        $animal = $animalRepository->findOneBy(['id' => $id_Animal]);
        $rapportMedical = $animal->getRapportMedical();
        return $this->render('prdv/canim.html.twig', ['rm' => $rapportMedical]);
    }
    #[Route('/lrdv/{id_Veto}', name: 'lrdv')] // c'est pour lister le rendez-vous mentionée
    public function index_lrdv($id_Veto,VeterinaireRepository $veterinaireRepository): Response{
        $veto=$veterinaireRepository->findOneBy(['id'=>$id_Veto]);
        $rendezVous = $veto->getRendezVouses();
        return $this->render('prdv/lrdv.html.twig', [
            'rdv'=>$rendezVous
        ]);}



}
