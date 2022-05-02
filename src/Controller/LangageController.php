<?php

namespace App\Controller;

use App\Entity\Outil;
use App\Entity\Langage;
use App\Entity\Framework;
use App\Form\LangageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class LangageController extends AbstractController
{
    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
    }

    /**
     * @Route("/langage", name="app_langage")
     */
    public function index(Request $request, SluggerInterface $slugger): Response
    {
        $langage = new Langage();

        $form = $this->createForm(LangageType::class, $langage);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $logoLangage = $form->get('logo')->getData();

            if($logoLangage){
                $originalFilename = pathinfo($logoLangage->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'-'.$logoLangage->guessExtension();

                try{
                    $logoLangage->move(
                        $this->getParameter('logo'),
                        $newFilename
                    );
                }catch(FileException $e){

                }

                $langage->setLogo($newFilename);
            }else{
                dd("Aucun logo");
            }
            $this->manager->persist($langage);
            $this->manager->flush();
            
            return $this->redirectToRoute('app_home');
        }

        return $this->render('langage/index.html.twig', [
            'langageForm' => $form->createView(),
        ]);
    }

    // ---------- DELETE ----------

    /**
     * @Route("admin/delete/langage/{id}", name="app_langage_delete")
     */
    public function langageDelete(Langage $langage): Response
    {
        $this->manager->remove($langage);
        $this->manager->flush();

        return $this->redirectToRoute('app_all_langage');
    }

    // ---------- DELTE DE FRAMEWORK ----------
    /**
     * @Route("/admin/delete/framework/{id}", name="app_framework_delete")
     */
    public function frameworkDelete(Framework $framework): Response
    {
        $this->manager->remove($framework);
        $this->manager->flush();

        return $this->redirectToRoute('app_all_langage');
    }

    // ---------- DELTE DE OUTIL ----------
    /**
     * @Route("/admin/delete/outil/{id}", name="app_outil_delete")
     */
    public function outilDelete(Outil $outil): Response
    {
        $this->manager->remove($outil);
        $this->manager->flush();

        return $this->redirectToRoute('app_all_langage');
    }

    // --------------------------------------------------------

    /**
     * @Route("/all/langage", name="app_all_langage")
     */
    public function allLangage(): Response
    {
        $framework = new Framework;
        $outil = new Outil;

        $langage = $this->manager->getRepository(Langage::class)->findAll();
        $framework = $this->manager->getRepository(Framework::class)->findAll();
        $outil = $this->manager->getRepository(Outil::class)->findAll();

        return $this->render('langage/allLangage.html.twig', [
            'langage' => $langage,
            'framework' => $framework,
            'outil' => $outil,
        ]);
    }

    // ---------- EDIT ----------

    /**
     * @Route("admin/edit/langage/{id}", name="app_langage_edit")
     */
    public function langageEdit(Langage $langage, Request $request, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(LangageType::class, $langage);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $logoLangage = $form->get('logo')->getData();

            if($logoLangage){
                $originalFilename = pathinfo($logoLangage->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '-' . $logoLangage->guessExtension();

                try{
                    $logoLangage->move(
                        $this->getParameter('logo'),
                        $newFilename
                    );
                }catch(FileException $e){
                    
                }
                $langage->setLogo($newFilename);
            }else{
                dd('Aucune photo disponible');
            };

            $this->manager->persist($langage);
            $this->manager->flush();
            return $this->redirectToRoute('app_all_langage');
        };

        return $this->render("langage/editLangage.html.twig", [
            'formEditLangage' => $form->createView(),
        ]);
    }
}