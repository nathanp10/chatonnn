<?php

namespace App\Controller;

use App\Entity\Proprietaires;
use App\Form\ProprietairesType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProprietairesController extends AbstractController
{
    /**
     * @Route("/proprietaires", name="app_proprietaires_voir")
     */

    public function index(ManagerRegistry $doctrine): Response
    {
        $repo = $doctrine->getRepository(Proprietaires::class);
        $proprietaires=$repo->findAll(); //select * transformé en liste de Categorie
        return $this->render('proprietaires/index.html.twig', [
            'controller_name' => 'ProprietairesController',

        ]);
    }

    /**
     * @Route("/proprietaires/ajouter/", name="app_proprietaires_ajouter")
     */
    public function ajouter(ManagerRegistry $doctrine, Request $request):Response
    {
        $proprietaires = new Proprietaires();


        $form = $this->createForm(ProprietairesType::class, $proprietaires);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($proprietaires);
            $em->flush();

            //retour à l'accueil
            return $this->redirectToRoute("app_categories");
        }

        return $this->render("proprietaires/ajouter.html.twig", [
            "formulaire"=> $form->createView()
        ]);
    }
}


















//public function index(): Response{
//    return $this->render('proprietaires/index.html.twig', [
  //      'controller_name' => 'ProprietairesController',
 //   ]);

