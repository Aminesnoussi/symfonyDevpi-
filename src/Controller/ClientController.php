<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Form\Annonces1Type;
use App\Repository\AnnoncesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/client')]
class ClientController extends AbstractController
{
    #[Route('/', name: 'app_client_index', methods: ['GET'])]
    public function index(AnnoncesRepository $annoncesRepository): Response
    {
        return $this->render('client/index.html.twig', [
            'annonces' => $annoncesRepository->findAll(),
        ]);
    }

    #[Route('/newclient', name: 'app_client_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AnnoncesRepository $annoncesRepository): Response
    {
        $annonce = new Annonces();
        $form = $this->createForm(Annonces1Type::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annoncesRepository->save($annonce, true);

            return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('client/new.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_client_show', methods: ['GET'])]
    public function show(Annonces $annonce): Response
    {
        return $this->render('client/show.html.twig', [
            'annonce' => $annonce,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Annonces $annonce, AnnoncesRepository $annoncesRepository): Response
    {
        $form = $this->createForm(Annonces1Type::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annoncesRepository->save($annonce, true);

            return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('client/edit.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_client_delete', methods: ['POST'])]
    public function delete(Request $request, Annonces $annonce, AnnoncesRepository $annoncesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$annonce->getId(), $request->request->get('_token'))) {
            $annoncesRepository->remove($annonce, true);
        }

        return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
    }
}
