<?php

namespace App\Controller;

use App\Entity\Outil;
use App\Form\OutilType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class OutilController extends AbstractController
{
    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
    }

    /**
     * @Route("/outil", name="app_outil")
     */
    public function index(Request $request, SluggerInterface $slugger): Response
    {
        $outil = new Outil;

        $form = $this->createForm(OutilType::class, $outil);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $logoOutil = $form->get('logo')->getData();
            
            if($logoOutil){
                $originalFilename = pathinfo($logoOutil->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '-' . $logoOutil->guessExtension();

                try{
                    $logoOutil->move(
                        $this->getParameter('logo'),
                        $newFilename
                    );
                }catch(FileException $e){
                    
                }
                $outil->setLogo($newFilename);
            }else{
                dd('Aucun logo');
            }
            $this->manager->persist($outil);
            $this->manager->flush();

            return $this->redirectToRoute('app_home');


        }

        return $this->render('outil/index.html.twig', [
            'outilForm' => $form->createView(),
        ]);
    }

    // ---------- EDIT ----------
    /**
     * @Route("admin/edit/outil/{id}", name="app_outil_edit")
     */
    public function outilEdit(Outil $outil, Request $request, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(OutilType::class, $outil);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $logoOutil = $form->get('logo')->getData();

            if($logoOutil){
                $originalFilename = pathinfo($logoOutil->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '-' . $logoOutil->guessExtension();

                try{
                    $logoOutil->move(
                        $this->getParameter('logo'),
                        $newFilename
                    );
                }catch(FileException $e){

                }
                $outil->setLogo($newFilename);
            }else{
                dd('Aucun logo');
            };

            $this->manager->persist($outil);
            $this->manager->flush();
            return $this->redirectToRoute('app_all_langage');
        }

        return $this->render("outil/editOutil.html.twig", [
            'formEditOutil' => $form->createView(),
        ]);

        
    }
}