<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/')]
    public function index(MailerInterface $mailer): Response
    {
        $email = new Email();

        $email
            ->from('jean.marius@dyosis.com')
            ->to('paulo.marius@dyosis.com')
            ->subject('SUper import email')
            ->text('Ceci est le contenu en text')
            ->html($this->renderView('Home/index.html.twig'))
        ;

        $mailer->send($email);

        return $this->render('Home/index.html.twig');
    }
}
