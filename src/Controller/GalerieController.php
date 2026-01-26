<?php

namespace App\Controller;

use App\Repository\LanterneRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class GalerieController extends AbstractController
{
    #[Route('/galerie', name: 'app_galerie')]
    public function index(LanterneRepository $lanterneRepository): Response
    {

        $lanterne = $lanterneRepository->findAll();
        return $this->render('Galerie/index.html.twig', [
            'lanterne' => $lanterne,
        ]);
    }
}
