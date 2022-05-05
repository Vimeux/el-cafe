<?php

namespace App\Controller;

use App\Entity\Coffee;
use App\Entity\User;
use App\Form\CoffeeType;
use App\Repository\CoffeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/coffee")
 */
class CoffeeController extends AbstractController
{
    /**
     * @Route("/", name="app_coffee_index", methods={"GET"})
     */
    public function index(CoffeeRepository $coffeeRepository): Response
    {
        return $this->render('coffee/index.html.twig', [
            'coffees' => $coffeeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_coffee_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $coffee = new Coffee();
        $form = $this->createForm(CoffeeType::class, $coffee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($coffee);
            $entityManager->flush();

            return $this->redirectToRoute('app_coffee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('coffee/new.html.twig', [
            'coffee' => $coffee,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_coffee_show", methods={"GET"})
     */
    public function show(ManagerRegistry $doctrine, Coffee $coffee): Response
    {   
        $coffee = $doctrine->getRepository(Coffee::class)->find($coffee);

        $seedTypes = $coffee->getSeedType()->current();
        
        return $this->render('coffee/show.html.twig', [
            'coffee' => $coffee,
            'seedTypes' => $seedTypes,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_coffee_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Coffee $coffee, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CoffeeType::class, $coffee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_coffee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('coffee/edit.html.twig', [
            'coffee' => $coffee,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_coffee_delete", methods={"POST"})
     */
    public function delete(Request $request, Coffee $coffee, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coffee->getId(), $request->request->get('_token'))) {
            $entityManager->remove($coffee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_coffee_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/favorite", name="app_coffee_favorite", methods={"GET"})
     */
    public function favorite(Coffee $coffee, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $coffee->addUser($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_coffee_index', [], Response::HTTP_SEE_OTHER);
    }

    // function to remove coffee from favorite
    /**
     * @Route("/{id}/unfavorite", name="app_coffee_unfavorite", methods={"GET"})
     */
    public function unfavorite(Coffee $coffee, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $coffee->removeUser($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_coffee_index', [], Response::HTTP_SEE_OTHER);
    }
}
