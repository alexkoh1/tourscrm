<?php

namespace App\Controller;

use App\Entity\Guide;
use App\Form\GuideType;
use App\Repository\GuideRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/guide")
 */
class GuideController extends Controller
{
    /**
     * @Route("/", name="guide_index", methods="GET")
     */
    public function index(GuideRepository $guideRepository): Response
    {
        return $this->render('guide/index.html.twig', ['guides' => $guideRepository->findAll()]);
    }

    /**
     * @Route("/new", name="guide_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $guide = new Guide();
        $form = $this->createForm(GuideType::class, $guide);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($guide);
            $em->flush();

            return $this->redirectToRoute('guide_index');
        }

        return $this->render('guide/new.html.twig', [
            'guide' => $guide,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="guide_show", methods="GET")
     */
    public function show(Guide $guide): Response
    {
        return $this->render('guide/show.html.twig', ['guide' => $guide]);
    }

    /**
     * @Route("/{id}/edit", name="guide_edit", methods="GET|POST")
     */
    public function edit(Request $request, Guide $guide): Response
    {
        $form = $this->createForm(GuideType::class, $guide);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('guide_edit', ['id' => $guide->getId()]);
        }

        return $this->render('guide/edit.html.twig', [
            'guide' => $guide,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="guide_delete", methods="DELETE")
     */
    public function delete(Request $request, Guide $guide): Response
    {
        if ($this->isCsrfTokenValid('delete'.$guide->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($guide);
            $em->flush();
        }

        return $this->redirectToRoute('guide_index');
    }
}
