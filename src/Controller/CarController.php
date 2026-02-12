<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CarController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(CarRepository $carRepository): Response
    {
        $cars = $carRepository->findAll();

        return $this->render('car/index.html.twig', [
            'cars' => $cars,
        ]);
    }

    #[Route('/car/{id}', name: 'app_car', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(?Car $car): Response
    {
        if (!$car) {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('car/show.html.twig', [
            'car' => $car,
        ]);
    }

    #[Route('/car/new', name: 'app_car_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($car);
            $manager->flush();

            return $this->redirectToRoute('app_car', ['id' => $car->getId()]);
        }

        return $this->render('car/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/car/{id}/delete', name: 'app_car_delete', requirements: ['id' => '\d+'], methods: ['GET', 'DELETE'])]
    public function delete(?Car $car, EntityManagerInterface $manager): Response
    {
        if (!$car) {
            return $this->redirectToRoute('app_home');
        }

        $manager->remove($car);
        $manager->flush();

        return $this->redirectToRoute('app_home');
    }
}
