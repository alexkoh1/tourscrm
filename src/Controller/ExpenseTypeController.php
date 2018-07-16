<?php

namespace App\Controller;

use App\Entity\ExpenseType;
use App\Form\ExpenseTypeForm;
use App\Repository\ExpenseTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/expense_type")
 */
class ExpenseTypeController extends Controller
{
    /**
     * @Route("/", name="expense_type_index", methods="GET")
     */
    public function index(ExpenseTypeRepository $expenseTypeRepository): Response
    {
        return $this->render('expense_type/index.html.twig', ['expense_types' => $expenseTypeRepository->findAll()]);
    }

    /**
     * @Route("/new", name="expense_type_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $expenseType = new ExpenseType();
        $form = $this->createForm(ExpenseTypeForm::class, $expenseType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($expenseType);
            $em->flush();

            return $this->redirectToRoute('expense_type_index');
        }

        return $this->render('expense_type/new.html.twig', [
            'expense_type' => $expenseType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="expense_type_show", methods="GET")
     */
    public function show(ExpenseType $expenseType): Response
    {
        return $this->render('expense_type/show.html.twig', ['expense_type' => $expenseType]);
    }

    /**
     * @Route("/{id}/edit", name="expense_type_edit", methods="GET|POST")
     */
    public function edit(Request $request, ExpenseType $expenseType): Response
    {
        $form = $this->createForm(ExpenseTypeForm::class, $expenseType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('expense_type_edit', ['id' => $expenseType->getId()]);
        }

        return $this->render('expense_type/edit.html.twig', [
            'expense_type' => $expenseType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="expense_type_delete", methods="DELETE")
     */
    public function delete(Request $request, ExpenseType $expenseType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$expenseType->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($expenseType);
            $em->flush();
        }

        return $this->redirectToRoute('expense_type_index');
    }
}
