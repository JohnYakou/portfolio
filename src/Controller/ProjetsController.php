<?php

namespace App\Controller;

use App\Entity\Projets;
use App\Form\ProjetsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ProjetsController extends AbstractController
{
    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
    }

    /**
     * @Route("/projets", name="app_projets")
     */
    public function index(Request $request, SluggerInterface $slugger): Response
    {
        $projets = new Projets;

        $form = $this->createForm(ProjetsType::class, $projets);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $imageProjets = $form->get('image')->getData();
        

            if($imageProjets){
                $originalFilename = pathinfo($imageProjets->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '-' . $imageProjets->guessExtension();

                try{
                    $imageProjets->move(
                        $this->getParameter('image'),
                        $newFilename
                    );
                }catch(FileException $e){

                }
                $projets->setImage($newFilename);
            }else{
                dd('Aucune image');
            }

            $this->manager->persist($projets);
            $this->manager->flush();

            return $this->redirectToRoute('app_all_projet');
        }

        return $this->render('projets/index.html.twig', [
            'projetsForm' => $form->createView(),
        ]);
    }

    // ---------- DELETE ----------

    /**
     * @Route("admin/delete/projets/{id}", name="app_projets_delete")
     */
    public function projetsDelete(Projets $projets): Response
    {
        $this->manager->remove($projets);
        $this->manager->flush();

        return $this->redirectToRoute('app_all_projet');
    }
}
