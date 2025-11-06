<?php

namespace App\Controller;

use App\Entity\Film;
use App\Form\FilmType;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FilmController extends AbstractController
{
    #[Route('/film', name: 'app_film')]
    public function index(FilmRepository $repo): Response
    {
        $films = $repo->findBy(["isValid"=> true]);
        return $this->render('film/index.html.twig', [
            'titre' => 'Liste des Films',
            'films' => $films
        ]);
    }
     #[Route('/film/ajouter', name: 'app_film_ajouter')]
    public function ajouter(EntityManagerInterface $em,Request $request): Response
    {
        $film = new Film();
        $form = $this->createForm(FilmType::class, $film);
         $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() )
        {
            //dump($film);
            $film->setIsValid(true);
            // le champ is majeur du formulaire
            $majeur = $form->get('isMajeur')->getData();
           if($majeur){
            $em->persist($film);
            $em->flush();
           }
           //dd($film);
           return $this->redirectToRoute("app_film");
        }
        return $this->render('film/ajouter.html.twig', [
            'titre' => 'Ajouter',
            'form' => $form
        ]);
    //    $film = new Film();
    //    $film->setTitre('Toto');
    //    $film->setAnnee('2024');
    //    $film->setRealisateur('Jean Dujardin');
    //    $film->setIsValid(true);
    //    $em->persist($film);
    //    $em->flush(); 
    //    return $this->redirectToRoute("app_film");

    }
    #[Route('/film/detail/{id}', name: 'app_film_detail')]
    public function detail(Film $film): Response
    {
        return $this->render('film/detail.html.twig', [
            'titre' => 'Detail',
            'film' => $film
        ]);
    }

    #[Route('/film/delete/{id}', name: 'app_film_delete')]
    public function effacer(Film $film,EntityManagerInterface $em): Response
    {
        $em->remove($film);
        $em->flush();
        return $this->redirectToRoute("app_film");
    }
}
