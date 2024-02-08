<?php

namespace App\Controller;

use App\Entity\CatProceso;
use App\Form\CatProcesoType;
use App\Repository\CatProcesoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cat/proceso')]
class CatProcesoController extends AbstractController
{
    #[Route('/', name: 'app_cat_proceso_index', methods: ['GET'])]
    public function index(CatProcesoRepository $catProcesoRepository): Response
    {
        return $this->render('cat_proceso/index.html.twig', [
            'cat_procesos' => $catProcesoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cat_proceso_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $catProceso = new CatProceso();
        $form = $this->createForm(CatProcesoType::class, $catProceso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($catProceso);
            $entityManager->flush();

            return $this->redirectToRoute('app_cat_proceso_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cat_proceso/new.html.twig', [
            'cat_proceso' => $catProceso,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cat_proceso_show', methods: ['GET'])]
    public function show(CatProceso $catProceso): Response
    {
        return $this->render('cat_proceso/show.html.twig', [
            'cat_proceso' => $catProceso,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cat_proceso_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CatProceso $catProceso, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CatProcesoType::class, $catProceso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cat_proceso_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cat_proceso/edit.html.twig', [
            'cat_proceso' => $catProceso,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cat_proceso_delete', methods: ['POST'])]
    public function delete(Request $request, CatProceso $catProceso, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$catProceso->getId(), $request->request->get('_token'))) {
            $entityManager->remove($catProceso);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cat_proceso_index', [], Response::HTTP_SEE_OTHER);
    }
}
