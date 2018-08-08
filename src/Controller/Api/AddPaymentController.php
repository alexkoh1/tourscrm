<?php

namespace App\Controller\Api;

use App\Entity\Payment;
use App\Form\PaymentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class AddPaymentController extends Controller
{
    /**
     * @Route("/add_payment", name="add_payment", methods="POST")
     */
    public function new(Request $request): JsonResponse
    {
        $payment = new Payment();
        $form = $this->createForm(PaymentType::class, $payment);
        //$form->handleRequest($request);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($payment);
            $em->flush();

            return new JsonResponse(['payment' => $payment->getSum()]);
        }
    }
}
