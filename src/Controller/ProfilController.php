<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function index(?UserInterface $user): Response
    {
        if (!$user) {
            return $this->redirectToRoute('home');
        } else {
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
        }
    }
}
