<?php

namespace App\Controller;

use App\Entity\Commandeachat;
use App\Form\CommandeachatType;
use App\Repository\CommandeachatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commandeachat")
 */
class CommandeachatController extends AbstractController
{
    /**
     * @Route("/", name="commandeachat_index", methods={"GET"})
     */
    public function index(CommandeachatRepository $commandeachatRepository): Response
    {
        return $this->render('commandeachat/index.html.twig', [
            'commandeachats' => $commandeachatRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="commandeachat_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commandeachat = new Commandeachat();
        $form = $this->createForm(CommandeachatType::class, $commandeachat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $d=date('dmysh');
            $commandeachat->setId($d);
            $entityManager->persist($commandeachat);
            $entityManager->flush();

            return $this->redirectToRoute('commandeachat_index');
        }

        return $this->render('commandeachat/new.html.twig', [
            'commandeachat' => $commandeachat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commandeachat_show", methods={"GET"})
     */
    public function show(Commandeachat $commandeachat): Response
    {
        return $this->render('commandeachat/show.html.twig', [
            'commandeachat' => $commandeachat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commandeachat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Commandeachat $commandeachat): Response
    {
        $form = $this->createForm(CommandeachatType::class, $commandeachat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commandeachat_index');
        }

        return $this->render('commandeachat/edit.html.twig', [
            'commandeachat' => $commandeachat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commandeachat_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Commandeachat $commandeachat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandeachat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commandeachat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commandeachat_index');
    }
}
