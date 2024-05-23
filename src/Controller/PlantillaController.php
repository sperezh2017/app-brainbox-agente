<?php

namespace App\Controller;

use App\Entity\ProEstados;
use App\Entity\ProEtiquetas;
use App\Entity\ProTransaccion;
use App\Form\ProTransaccionType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ProTransaccionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/plantilla')]
class PlantillaController extends AbstractController
{
    private $em;

    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager();
    }

    #[Route('/', name: 'app_plantilla_index', methods: ['GET'])]
    public function index(ProTransaccionRepository $proTransaccionRepository): Response
    {
        $etiquetas = $this->em->getRepository(ProEtiquetas::class)->findAll();
        $estados   = $this->em->getRepository(ProEstados::class)->findAll();
        return $this->render('plantilla/index.html.twig', [
            'pro_transaccions' => $proTransaccionRepository->findAll(),
            'etiquetas' => $etiquetas,
            'estados'  => $estados
        ]);
    }

    #[Route('/new', name: 'app_plantilla_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $proTransaccion = new ProTransaccion();
        $form = $this->createForm(ProTransaccionType::class, $proTransaccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($proTransaccion);
            $entityManager->flush();

            return $this->redirectToRoute('app_plantilla_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plantilla/new.html.twig', [
            'pro_transaccion' => $proTransaccion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plantilla_show', methods: ['GET'])]
    public function show(ProTransaccion $proTransaccion): Response
    {
        return $this->render('plantilla/show.html.twig', [
            'pro_transaccion' => $proTransaccion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_plantilla_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProTransaccion $proTransaccion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProTransaccionType::class, $proTransaccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_plantilla_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plantilla/edit.html.twig', [
            'pro_transaccion' => $proTransaccion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plantilla_delete', methods: ['POST'])]
    public function delete(Request $request, ProTransaccion $proTransaccion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$proTransaccion->getId(), $request->request->get('_token'))) {
            $entityManager->remove($proTransaccion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_plantilla_index', [], Response::HTTP_SEE_OTHER);
    }
}
