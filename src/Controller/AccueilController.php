<?php

namespace App\Controller;

use App\Repository\LanterneRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(LanterneRepository $lanterneRepository): Response
    {

        $lanterne = $lanterneRepository->findFour();
        return $this->render('Accueil/index.html.twig', [
            'lanterne' => $lanterne,
        ]);
    }
}
