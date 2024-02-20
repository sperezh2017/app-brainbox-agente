<?php

namespace App\Controller;

use App\Entity\CatMes;
use App\Entity\CatDias;
use App\Entity\CatGrupo;
use App\Entity\CatEntidad;
use App\Entity\CatProceso;
use App\Entity\TipoProceso;
use App\Form\CatProcesoType;
use App\Entity\CatRecurrencia;
use App\Entity\VariableInicio;
use App\Repository\CatProcesoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/cat/proceso')]
class CatProcesoController extends AbstractController
{
    private $em;

    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager();
    }
    
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

    #[Route('/vista', name: 'app_cat_proceso_show', methods: ['GET', 'POST'])]
    public function show(Request $request): Response
    {
        $idproceso = $request->get('procesoid');
        $proceso   = $this->em->getRepository(CatProceso::class)->findOneById($idproceso);
        $dias      = $this->em->getRepository(CatDias::class)->findAll();
        $mes       = $this->em->getRepository(CatMes::class)->findAll();
        $recurenc  = $this->em->getRepository(CatRecurrencia::class)->findAll();
        $entidades = $this->em->getRepository(CatEntidad::class)->findAll();
        $grupos    = $this->em->getRepository(CatGrupo::class)->findAll();
        $tipprocess = $this->em->getRepository(TipoProceso::class)->findAll();
        $tipoid     = $proceso->getTipoProceso();
        $variables = $this->em->getRepository(VariableInicio::class)->findByTipoProceso($tipoid);

        return $this->render('cat_proceso/show.html.twig', [
            'proceso'      => $proceso,
            'dias'         => $dias,
            'mess'         => $mes,
            'recurrencias' => $recurenc,
            'entidades'    => $entidades,
            'grupos'       => $grupos,
            'tipoprocesos' => $tipprocess,
            'variables'    => $variables,
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

    #[Route('/{id}/eliminar', name: 'app_cat_proceso_delete', methods: ['POST'])]
    public function delete(Request $request, CatProceso $catProceso, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$catProceso->getId(), $request->request->get('_token'))) {
            $entityManager->remove($catProceso);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cat_proceso_index', [], Response::HTTP_SEE_OTHER);
    }
}
