<?php

namespace App\Controller;

use App\Entity\Cheque;
use App\Form\ChequeType;
use App\Repository\ChequeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cheque")
 */
class ChequeController extends AbstractController
{
    /**
     * @Route("/", name="cheque_index", methods={"GET"})
     */
    public function index(ChequeRepository $chequeRepository): Response
    {
        return $this->render('cheque/index.html.twig', [
            'cheques' => $chequeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cheque_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cheque = new Cheque();
        $form = $this->createForm(ChequeType::class, $cheque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $d=date('dmysh');
            $cheque->setId($d);
            $entityManager->persist($cheque);
            $entityManager->flush();

            return $this->redirectToRoute('cheque_index');
        }

        return $this->render('cheque/new.html.twig', [
            'cheque' => $cheque,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cheque_show", methods={"GET"})
     */
    public function show(Cheque $cheque): Response
    {
        return $this->render('cheque/show.html.twig', [
            'cheque' => $cheque,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cheque_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cheque $cheque): Response
    {
        $form = $this->createForm(ChequeType::class, $cheque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cheque_index');
        }

        return $this->render('cheque/edit.html.twig', [
            'cheque' => $cheque,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cheque_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cheque $cheque): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cheque->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cheque);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cheque_index');
    }
}
