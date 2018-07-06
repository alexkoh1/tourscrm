<?php

namespace App\Controller;

use App\Entity\Tour;
use App\Form\TourType;
use App\Repository\ToursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tour")
 */
class TourController extends Controller
{
    /**
     * @Route("/", name="tour_index", methods="GET")
     */
    public function index(ToursRepository $toursRepository): Response
    {
        return $this->render('tour/index.html.twig', ['tours' => $toursRepository->findAll()]);
    }

    /**
     * @Route("/new", name="tour_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $tour = new Tour();
        $form = $this->createForm(TourType::class, $tour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tour);
            $em->flush();

            return $this->redirectToRoute('tour_index');
        }

        return $this->render('tour/new.html.twig', [
            'tour' => $tour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tour_show", methods="GET")
     */
    public function show(Tour $tour): Response
    {
        return $this->render('tour/show.html.twig', ['tour' => $tour]);
    }

    /**
     * @Route("/{id}/edit", name="tour_edit", methods="GET|POST")
     */
    public function edit(Request $request, Tour $tour): Response
    {
        $form = $this->createForm(TourType::class, $tour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tour_edit', ['id' => $tour->getId()]);
        }

        return $this->render('tour/edit.html.twig', [
            'tour' => $tour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tour_delete", methods="DELETE")
     */
    public function delete(Request $request, Tour $tour): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tour->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tour);
            $em->flush();
        }

        return $this->redirectToRoute('tour_index');
    }
}
