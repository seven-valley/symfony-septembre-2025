<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]
    public function index(): Response
    {
       $personnes =[
            0 => ["prenom"=>"Brad","nom"=>"PITT"],
            1 => ["prenom"=>"Angelina","nom"=>"JOLIE"],
            2 => ["prenom"=>"Tom","nom"=>"CRUISE"],
        ];
       
        return $this->render('main/index.html.twig', [
            'titre'=> 'Titre demo',
            'personnes'=>$personnes
            
        ]);
    }
   
}
