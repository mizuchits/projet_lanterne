<?php

namespace App\Controller;

use App\Entity\Lanterne;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\LanterneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class DetailController extends AbstractController
{
    #[Route('/lanterne/{id}', name: 'app_detail')]
    public function index(lanterne $lanterne, ?Commentaire $commentaire, lanterneRepository $lanterneRepository, Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {

        if (!$commentaire) {
            $commentaire = new commentaire;
        }

        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire->setUser($security->getUser());
            $commentaire->setlanterne($lanterne);

            $entityManager->persist($commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_detail', ['id' => $lanterne->getId()]);
        }

        $lanterne = $lanterneRepository->findOneBy(['id' => $lanterne->getId()]);
        return $this->render('detail/index.html.twig', [
            'lanterne' => $lanterne,
            'Commentaire' => $form->createView(),
        ]);
    }
}
