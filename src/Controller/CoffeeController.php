<?php

namespace App\Controller;

use App\Repository\CoffeeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

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
}