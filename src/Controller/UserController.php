<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\User\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/create', name: 'app_create')]
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_home_index');
        } else if ($form->isSubmitted()) {
            // Ici -> not valid
            dump($form->getErrors(true));
        }

        return $this->render('User/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
