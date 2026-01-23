<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\LanterneRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mime\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(Request $request, LanterneRepository $lanterneRepository, MailerInterface $mailer): Response
    {
        $lanterne = $lanterneRepository->findFour();
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $email = (new Email())
                ->from($data['email'])
                ->to('marin.tom65@gmail.com')
                ->subject('Nouveau message de contact')
                ->text(
                    "nom: [{$data['name']}]\n" .
                    "email: [{$data['email']}]\n\n" .
                    "Message:\n{$data['message']}"
                );
            $mailer->send($email);
        }

        return $this->render('Accueil/index.html.twig', [
            'lanterne' => $lanterne,
            'Contact' => $form->createView(),
        ]);
    }
}
