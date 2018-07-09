<?php

namespace App\Controller;

use App\Entity\ClientsToursCost;
use App\Form\ClientsToursCostType;
use App\Repository\ClientsToursCostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/clients/tours/cost")
 */
class ClientsToursCostController extends Controller
{
    /**
     * @Route("/", name="clients_tours_cost_index", methods="GET")
     */
    public function index(ClientsToursCostRepository $clientsToursCostRepository): Response
    {
        return $this->render('clients_tours_cost/index.html.twig', ['clients_tours_costs' => $clientsToursCostRepository->findAll()]);
    }

    /**
     * @Route("/new", name="clients_tours_cost_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $clientsToursCost = new ClientsToursCost();
        $form = $this->createForm(ClientsToursCostType::class, $clientsToursCost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($clientsToursCost);
            $em->flush();

            return $this->redirectToRoute('clients_tours_cost_index');
        }

        return $this->render('clients_tours_cost/new.html.twig', [
            'clients_tours_cost' => $clientsToursCost,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="clients_tours_cost_show", methods="GET")
     */
    public function show(ClientsToursCost $clientsToursCost): Response
    {
        return $this->render('clients_tours_cost/show.html.twig', ['clients_tours_cost' => $clientsToursCost]);
    }

    /**
     * @Route("/{id}/edit", name="clients_tours_cost_edit", methods="GET|POST")
     */
    public function edit(Request $request, ClientsToursCost $clientsToursCost): Response
    {
        $form = $this->createForm(ClientsToursCostType::class, $clientsToursCost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('clients_tours_cost_edit', ['id' => $clientsToursCost->getId()]);
        }

        return $this->render('clients_tours_cost/edit.html.twig', [
            'clients_tours_cost' => $clientsToursCost,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="clients_tours_cost_delete", methods="DELETE")
     */
    public function delete(Request $request, ClientsToursCost $clientsToursCost): Response
    {
        if ($this->isCsrfTokenValid('delete'.$clientsToursCost->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($clientsToursCost);
            $em->flush();
        }

        return $this->redirectToRoute('clients_tours_cost_index');
    }
}
