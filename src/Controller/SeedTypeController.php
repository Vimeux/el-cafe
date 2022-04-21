<?php

namespace App\Controller;

use App\Entity\SeedType;
use App\Form\SeedTypeType;
use App\Repository\SeedTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/seedtype")
 */
class SeedTypeController extends AbstractController
{
    /**
     * @Route("/", name="app_seed_type_index", methods={"GET"})
     */
    public function index(SeedTypeRepository $seedTypeRepository): Response
    {
        return $this->render('seed_type/index.html.twig', [
            'seed_types' => $seedTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_seed_type_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $seedType = new SeedType();
        $form = $this->createForm(SeedTypeType::class, $seedType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($seedType);
            $entityManager->flush();

            return $this->redirectToRoute('app_seed_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('seed_type/new.html.twig', [
            'seed_type' => $seedType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_seed_type_show", methods={"GET"})
     */
    public function show(SeedType $seedType): Response
    {
        return $this->render('seed_type/show.html.twig', [
            'seed_type' => $seedType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_seed_type_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, SeedType $seedType, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SeedTypeType::class, $seedType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_seed_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('seed_type/edit.html.twig', [
            'seed_type' => $seedType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_seed_type_delete", methods={"POST"})
     */
    public function delete(Request $request, SeedType $seedType, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seedType->getId(), $request->request->get('_token'))) {
            $entityManager->remove($seedType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_seed_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
