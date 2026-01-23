<?php

namespace App\Controller;

use App\Entity\Lanterne;
use App\Form\NewLanterneType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class NewLanterneController extends AbstractController
{
    #[Route('/new/lanterne', name: 'app_new_lanterne')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $lanterne = new Lanterne();

        $form = $this->createForm(NewLanterneType::class, $lanterne);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        
            $lanterne->setUser($this->getUser());
            $entityManager->persist($lanterne);
            $entityManager->flush();
            $this->addFlash('success','Article ajouté avec succès !');
            return $this->redirectToRoute('app_galerie');
        
        }


        return $this->render('new_lanterne/index.html.twig', [
            'controller_name' => 'NewLanterneController',
            'Newlanterne'=>$form->createView(),
        ]);
    }
}
