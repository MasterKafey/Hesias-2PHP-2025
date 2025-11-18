<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home_index')]
    public function index(
        EntityManagerInterface $entityManager
    ): Response
    {
        $users = $entityManager->getRepository(User::class)->findAll();

        $articles = $entityManager->getRepository(Article::class)->findAll();

        return $this->render('Page/Home/index.html.twig', [
            'users' => $users,
            'articles' => $articles
        ]);
    }

    #[Route('/contact/{name}', name: 'app_home_contact')]
    public function contact(string $name): Response
    {
        return $this->render('Page/Home/contact.html.twig', [
            'name' => $name,
        ]);
    }

    #[Route('/team', name: 'app_home_team')]
    public function team(): Response
    {
        return $this->render('Page/Home/team.html.twig');
    }

    #[Route('/cgu', name: 'app_home_cgu')]
    public function cgu(): Response
    {
        return $this->render('Page/Home/cgu.html.twig');
    }
}
