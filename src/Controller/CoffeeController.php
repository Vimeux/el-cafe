<?php

namespace App\Controller;

use App\Repository\CoffeeRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api/coffee", name="coffee_")
 */
class CoffeeController extends AbstractController
{
  /**
   * @Route("", name="get", methods={"GET"})
   */
  public function getAll(
    CoffeeRepository $coffeeRepository,
    SerializerInterface $serializer
  ): Response {
    (new ObjectNormalizer())->setSerializer($serializer);

    $coffees = $coffeeRepository->findAll();

    return new JsonResponse($serializer->normalize($coffees, null, ['groups' => 'coffee']));
  }

  /**
   * @Route("/{id}", name="get_one", methods={"GET"})
   */
  public function getOne(
    CoffeeRepository $coffeeRepository,
    SerializerInterface $serializer,
    int $id
  ): Response {
    (new ObjectNormalizer())->setSerializer($serializer);

    $coffee = $coffeeRepository->find($id);

    if (!$coffee) {
      throw $this->createNotFoundException(sprintf("%s is not a known coffee", $id));
    }

    return new JsonResponse($serializer->normalize($coffee, null, ['groups' => 'coffee']));
  }

  /**
   * @Route("", name="post", methods={"POST"}, format="json")
   */
  public function post(
    CoffeeRepository $coffeeRepository,
    EntityManager $entityManager,
    SerializerInterface $serializer,
    Request $request,
    ValidatorInterface $validator
  ): Response {
    
  }
}
