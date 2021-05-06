<?php

namespace App\Controller;

use App\Entity\Paiment;
use App\Form\PaimentType;
use App\Repository\PaimentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/paiment")
 */
class PaimentController extends AbstractController
{
    /**
     * @Route("/", name="paiment_index", methods={"GET"})
     */
    public function index(PaimentRepository $paimentRepository): Response
    {
        return $this->render('paiment/index.html.twig', [
            'paiments' => $paimentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="paiment_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $paiment = new Paiment();
        $form = $this->createForm(PaimentType::class, $paiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $d=date('dmysh');
            $paiment->setId($d);
            $entityManager->persist($paiment);
            $entityManager->flush();

            return $this->redirectToRoute('paiment_index');
        }

        return $this->render('paiment/new.html.twig', [
            'paiment' => $paiment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="paiment_show", methods={"GET"})
     */
    public function show(Paiment $paiment): Response
    {
        return $this->render('paiment/show.html.twig', [
            'paiment' => $paiment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="paiment_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Paiment $paiment): Response
    {
        $form = $this->createForm(PaimentType::class, $paiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('paiment_index');
        }

        return $this->render('paiment/edit.html.twig', [
            'paiment' => $paiment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="paiment_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Paiment $paiment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$paiment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($paiment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('paiment_index');
    }
}
