<?php

namespace App\Controller;

use App\Entity\Commandevente;
use App\Form\CommandeventeType;
use App\Repository\CommandeventeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commandevente")
 */
class CommandeventeController extends AbstractController
{
    /**
     * @Route("/", name="commandevente_index", methods={"GET"})
     */
    public function index(CommandeventeRepository $commandeventeRepository): Response
    {
        return $this->render('commandevente/index.html.twig', [
            'commandeventes' => $commandeventeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="commandevente_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commandevente = new Commandevente();
        $form = $this->createForm(CommandeventeType::class, $commandevente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $d=date('dmysh');
            $commandevente->setId($d);
            foreach($commandevente->getCommandeventeProduits() as $lcp){
                $lcp->setCommandevente($commandevente);
                $lcp->getProduit()->setQteStock($lcp->getProduit()->getQteStock()-$lcp->getQteCom());
                $lcp->setPrix($lcp->getProduit()->getPrixTTC()*$lcp->getQteCom());
                $commandevente->setTotal($commandevente->getTotal()+$lcp->getPrix());            
            }
            $entityManager->persist($commandevente);
            $entityManager->flush();

            return $this->redirectToRoute('commandevente_index');
        }

        return $this->render('commandevente/new.html.twig', [
            'commandevente' => $commandevente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commandevente_show", methods={"GET"})
     */
    public function show(Commandevente $commandevente): Response
    {
        return $this->render('commandevente/show.html.twig', [
            'commandevente' => $commandevente,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commandevente_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Commandevente $commandevente): Response
    {
        $form = $this->createForm(CommandeventeType::class, $commandevente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commandevente_index');
        }

        return $this->render('commandevente/edit.html.twig', [
            'commandevente' => $commandevente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commandevente_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Commandevente $commandevente): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandevente->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commandevente);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commandevente_index');
    }
}
