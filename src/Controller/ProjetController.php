<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Entity\Projets;
use App\Form\ProjetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ProjetController extends AbstractController
{
    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
    }

    /**
     * @Route("/projet", name="app_projet")
     */
    public function index(Request $request, SluggerInterface $slugger): Response
    {
        $projet = new Projet;

        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $imageProjet = $form->get('image')->getData();
        

            if($imageProjet){
                $originalFilename = pathinfo($imageProjet->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '-' . $imageProjet->guessExtension();

                try{
                    $imageProjet->move(
                        $this->getParameter('image'),
                        $newFilename
                    );
                }catch(FileException $e){

                }
                $projet->setImage($newFilename);
            }else{
                dd('Aucune image');
            }

            $this->manager->persist($projet);
            $this->manager->flush();

            return $this->redirectToRoute('app_home');
        }            
        return $this->render('projet/index.html.twig', [
            'projetForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/all/projet", name="app_all_projet")
     */
    public function allProjet() : Response
    {
        $projet = $this->manager->getRepository(Projet::class)->findAll();

        $projets = new Projets;
        $projets = $this->manager->getRepository(Projets::class)->findAll();

        return $this->render('projet/allProjet.html.twig', [
            'projet' => $projet,
            'projets' => $projets,
        ]);
    }

    // ---------- DELETE ----------

    /**
     * @Route("admin/delete/projet/{id}", name="app_projet_delete")
     */
    public function projetDelete(Projet $projet): Response
    {
        $this->manager->remove($projet);
        $this->manager->flush();

        return $this->redirectToRoute('app_all_projet');
    }

    // ---------- EDIT ----------

    /**
     * @Route("admin/edit/projet/{id}", name="app_projet_edit")
     */
    public function projetEdit(Projet $projet, Request $request, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $imageProjet = $form->get('image')->getData();

            if($imageProjet){
                $originalFilename = pathinfo($imageProjet->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '-' . $imageProjet->guessExtension();

                try{
                    $imageProjet->move(
                        $this->getParameter('image'),
                        $newFilename
                    );
                }catch(FileException $e){
                    
                }
                $projet->setImage($newFilename);
            }else{
                dd('Aucune image');
            };

            $this->manager->persist($projet);
            $this->manager->flush();
            return $this->redirectToRoute('app_all_projet');
        };

        return $this->render("projet/editProjet.html.twig", [
            'formEditProjet' => $form->createView(),
        ]);
    }

    // SINGLE PROJET
    /**
     * @Route("/solo/projet/{id}", name="app_solo_projet")
     */
    public function solo(Projet $id): Response{
        $projet = $this->manager->getRepository(Projet::class)->find($id);

        return $this->render('projet/soloProjet.html.twig', [
            'projet' => $projet,
        ]);
    }
}