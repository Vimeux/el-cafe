<?php

namespace App\Controller;

use App\Entity\CoffeeShop;
use App\Form\CoffeeShopType;
use App\Repository\CoffeeShopRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/coffeeshop")
 */
class CoffeeShopController extends AbstractController
{
    /**
     * @Route("/", name="app_coffee_shop_index", methods={"GET"})
     */
    public function index(CoffeeShopRepository $coffeeShopRepository): Response
    {
        return $this->render('coffee_shop/index.html.twig', [
            'coffee_shops' => $coffeeShopRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_coffee_shop_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $coffeeShop = new CoffeeShop();
        $form = $this->createForm(CoffeeShopType::class, $coffeeShop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($coffeeShop);
            $entityManager->flush();

            return $this->redirectToRoute('app_coffee_shop_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('coffee_shop/new.html.twig', [
            'coffee_shop' => $coffeeShop,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_coffee_shop_show", methods={"GET"})
     */
    public function show(CoffeeShop $coffeeShop): Response
    {
        return $this->render('coffee_shop/show.html.twig', [
            'coffee_shop' => $coffeeShop,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_coffee_shop_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CoffeeShop $coffeeShop, EntityManagerInterface $entityManager): Response
    {   
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Vous n\'avez pas accès à cette page.');
        $form = $this->createForm(CoffeeShopType::class, $coffeeShop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_coffee_shop_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('coffee_shop/edit.html.twig', [
            'coffee_shop' => $coffeeShop,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_coffee_shop_delete", methods={"POST"})
     */
    public function delete(Request $request, CoffeeShop $coffeeShop, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coffeeShop->getId(), $request->request->get('_token'))) {
            $entityManager->remove($coffeeShop);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_coffee_shop_index', [], Response::HTTP_SEE_OTHER);
    }
}
