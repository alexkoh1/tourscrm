<?php

namespace App\Controller;

use App\Entity\ClientTourCost;
use App\Form\ClientTourCostType;
use App\Repository\ClientsToursCostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/client_tour")
 */
class ClientTourCostController extends Controller
{
    /**
     * @Route("/", name="client_tour_cost_index", methods="GET")
     */
    public function index(ClientsToursCostRepository $clientsToursCostRepository): Response
    {
        return $this->render('client_tour_cost/index.html.twig', ['client_tour_costs' => $clientsToursCostRepository->findAll()]);
    }

    /**
     * @Route("/new", name="client_tour_cost_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $clientTourCost = new ClientTourCost();
        $form = $this->createForm(ClientTourCostType::class, $clientTourCost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($clientTourCost);
            $em->flush();

            return $this->redirectToRoute('client_tour_cost_index');
        }

        return $this->render('client_tour_cost/new.html.twig', [
            'client_tour_cost' => $clientTourCost,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="client_tour_cost_show", methods="GET")
     */
    public function show(ClientTourCost $clientTourCost): Response
    {
        return $this->render('client_tour_cost/show.html.twig', ['client_tour_cost' => $clientTourCost]);
    }

    /**
     * @Route("/{id}/edit", name="client_tour_cost_edit", methods="GET|POST")
     */
    public function edit(Request $request, ClientTourCost $clientTourCost): Response
    {
        $form = $this->createForm(ClientTourCostType::class, $clientTourCost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('client_tour_cost_edit', ['id' => $clientTourCost->getId()]);
        }

        return $this->render('client_tour_cost/edit.html.twig', [
            'client_tour_cost' => $clientTourCost,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="client_tour_cost_delete", methods="DELETE")
     */
    public function delete(Request $request, ClientTourCost $clientTourCost): Response
    {
        if ($this->isCsrfTokenValid('delete'.$clientTourCost->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($clientTourCost);
            $em->flush();
        }

        return $this->redirectToRoute('client_tour_cost_index');
    }
}
