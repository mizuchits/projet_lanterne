<?php

namespace App\Controller;

use App\Entity\Lanterne;
use App\Repository\LanterneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class DetailController extends AbstractController
{
    #[Route('/detail', name: 'app_detail')]
    public function index(Lanterne $lanterne, LanterneRepository $lanterneRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $lanterne = $lanterneRepository->findOneBy(['id' => $lanterne->getId()]);
        return $this->render('detail/index.html.twig', [
            'lanterne' => $lanterne,
        ]);
    }
}
