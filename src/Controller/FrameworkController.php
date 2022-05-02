<?php

namespace App\Controller;

use App\Entity\Framework;
use App\Form\FrameworkType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class FrameworkController extends AbstractController
{
    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
    }

    /**
     * @Route("/framework", name="app_framework")
     */
    public function index(Request $request, SluggerInterface $slugger): Response
    {
        $framework = new Framework;

        $form = $this->createForm(FrameworkType::class, $framework);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $logoFramework = $form->get('logo')->getData();

            if($logoFramework){
                $originalFilename = pathinfo($logoFramework->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '-' . $logoFramework->guessExtension();

                try{
                    $logoFramework->move(
                        $this->getParameter('logo'),
                        $newFilename
                    );
                }catch(FileException $e){

                }

                $framework->setLogo($newFilename);
            }else{
                dd('Aucun logo');
            }

            $this->manager->persist($framework);
            $this->manager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('framework/index.html.twig', [
            'frameworkForm' => $form->createView(),
        ]);
    }

    // /**
    //  * @Route("/all/frame", name="app_all_frame")
    //  */
    // public function allLFrame(): Response
    // {
    //     $framework = new Framework;

    //     $framework = $this->manager->getRepository(Framework::class)->findAll();

    //     return $this->render('langage/allLangage.html.twig', [
    //         'framework' => $framework,
    //     ]);
    // }

    // ---------- EDIT ----------
    /**
     * @Route("admin/edit/framework/{id}", name="app_framework_edit")
     */
    public function frameworkEdit(Framework $framework, Request $request, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(FrameworkType::class, $framework);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $logoFramework = $form->get('logo')->getData();

            if($logoFramework){
                $originalFilename = pathinfo($logoFramework->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '-' . $logoFramework->guessExtension();

                try{
                    $logoFramework->move(
                        $this->getParameter('logo'),
                        $newFilename
                    );
                }catch(FileException $e){
                    
                }
                $framework->setLogo($newFilename);
            }else{
                dd('Aucune photo disponible');
            };

            $this->manager->persist($framework);
            $this->manager->flush();
            return $this->redirectToRoute('app_all_langage');
        };

        return $this->render("framework/FrameworkEdit.html.twig", [
            'formEditFramework' => $form->createView(),
        ]);
    }
}