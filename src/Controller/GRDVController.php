<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\RapportMedical;
use App\Entity\RendezVous;
use App\Entity\Veterinaire;
use App\Form\RapportMedicalType;
use App\Form\RdvType;
use App\Repository\AnimalRepository;
use App\Repository\DecisionRepository;
use App\Repository\RapportMedicalRepository;
use App\Repository\RendezVousRepository;
use App\Repository\VeterinaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GRDVController extends AbstractController
{
    #[Route('/formanimal/{id_Animal}', name: 'formanimal')]
    public function Affiche($id_Animal,\Symfony\Component\HttpFoundation\Request $request): Response {
        $idAnimal = $id_Animal;
        $em=$this->getDoctrine()->getManager();
        $animal = $em->getRepository(Animal::class)->find($idAnimal);
        $rm=new RapportMedical();
        $form=$this->createForm(RapportMedicalType::class,$rm, [
            'animal' => $animal
        ]);
        $form->add('Valider',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($rm);
            $em->flush();
            return $this->redirectToRoute('rmverified');
        }
        return $this->renderForm('grdv/form.html.twig',[
            'formulaire'=>$form
        ]);}

    #[Route('/updaterm/{id_Animal}', name: 'updaterm')]
    public function Update_rm($id_Animal,RapportMedicalRepository $repo,\Symfony\Component\HttpFoundation\Request $request): Response {
            $rdv=$repo->find($id_Animal);
            $formulaire=$this->createForm(RapportMedicalType::class,$rdv);
            $formulaire->add('Update',SubmitType::class);
            $formulaire->handleRequest($request);
            if($formulaire->isSubmitted() && $formulaire->isValid()){
                $em=$this->getDoctrine()->getManager();
                $em->flush();
                return  $this->redirectToRoute('rmverified');
            }
            return $this->render('grdv/form.html.twig', [
                'formulaire'=>$formulaire->createView()
            ]);
        }

    #[Route('/rmverified', name: 'rmverified')] // c'est la page de validation de rm
    public function index_rmverified(): Response
    {
        return $this->render('/grdv/rmverified.html.twig');
    }

    #[Route('/updatev/{id}', name: 'updatev')]//update du rdv
    public function Update($id, RendezVousRepository $repo,\Symfony\Component\HttpFoundation\Request $request): Response {
        $rdv=$repo->find($id);
        $formulaire=$this->createForm(RdvType::class,$rdv);
        $formulaire->add('Update',SubmitType::class);
        $formulaire->handleRequest($request);
        if($formulaire->isSubmitted() && $formulaire->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return  $this->redirectToRoute('rdverifiedveto');
        }
        return $this->render('grdv/formvetrdv.html.twig', [
            'formulaire'=>$formulaire->createView()
        ]);
    }





    #[Route('/grm', name: 'grm')]//c'est pour lister les animaux est affecté a un d'eux un rapport médical
    public function index_grm(AnimalRepository $repository): Response
    {
        $animal=$repository->findAll();
        return $this->render('grdv/index.html.twig',['animal'=>$animal]);
    }

    #[Route('/rdverifiedveto', name: 'rdverifiedveto')]
    public function index_rdverified(): Response
    {
        return $this->render('/grdv/rdverifiedveto.html.twig');
    }

    #[Route('/mrm', name: 'mrm')]  //c'est pour chercher mes rapports médicaux
    public function index_mrdv(AnimalRepository $repository): Response{
            $animal=$repository->findAll();
        return $this->render('grdv/mrm.html.twig',['animal'=>$animal]);}

    #[Route('/crmveto/{id_Animal}', name: 'crmveto')] // c'est pour lister le rapport médical mentionnée
    public function index_($id_Animal, AnimalRepository $animalRepository): Response
    {
        $animal = $animalRepository->findOneBy(['id' => $id_Animal]);
        $rapportMedical = $animal->getRapportMedical();
        return $this->render('grdv/canim.html.twig', ['rm' => $rapportMedical]);
    }

    #[Route('/deleterm/{id}', name: 'suprm')]
    public function Delete($id,RapportMedicalRepository $repo): Response {
        $rm=$repo->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($rm);
        $em->flush();
        return  $this->redirectToRoute('/veterinaire');
    }

    #[Route('/desrdv', name: 'desrdv')] //c'est pour lister mes rendez-vous
    public function index_desrdv(RendezVousRepository $Repository): Response{
        $rdv=$Repository->findAll();
        return $this->render('grdv/desrdv.html.twig', [
            'rdv'=>$rdv
        ]);}
}
