<?php

namespace App\Controller;

use App\Entity\Lanterne;
use App\Form\NewLanterneType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class EditLanterneController extends AbstractController
{
    #[Route('/lanterne/{id}/edit', name: 'app_edit_lanterne')]
    public function edit(Lanterne $lanterne, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($lanterne->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException('Vous ne pouvez pas éditer cette lanterne.');
        }

        $form = $this->createForm(NewLanterneType::class, $lanterne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Lanterne modifiée avec succès !');
            return $this->redirectToRoute('app_galerie');
        }

        return $this->render('edit_lanterne/index.html.twig', [
            'lanterne' => $lanterne,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/lanterne/{id}/delete', name: 'app_delete_lanterne')]
    public function delete(Lanterne $lanterne, EntityManagerInterface $entityManager): Response
    {
        if ($lanterne->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException('Vous ne pouvez pas supprimer cette lanterne.');
        }

        $entityManager->remove($lanterne);
        $entityManager->flush();

        $this->addFlash('success', 'Lanterne supprimée avec succès !');
        return $this->redirectToRoute('app_galerie');
    }
}
