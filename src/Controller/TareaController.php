<?php

namespace App\Controller;

use Exception;
use App\Entity\Tarea;
use App\Form\TareaType;
use App\Entity\CatProceso;
use App\Entity\CatSubProcesos;
use App\Repository\TareaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/tarea')]
class TareaController extends AbstractController
{
    private $em;

    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager();
    }

    #[Route('/', name: 'app_tarea_index', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        $idproceso = $request->get('procesoid');
        $proceso   = $this->em->getRepository(CatProceso::class)->findOneById($idproceso);
        $tareas    = $this->em->getRepository(Tarea::class)->findByProceso($proceso);
        return $this->render('tarea/index.html.twig', [
            'tareas'  =>  $tareas,
            'proceso' =>  $proceso 
        ]);
    }

    #[Route('/new', name: 'app_tarea_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $idproceso = $request->get('proceso');
        $nombTarea = $request->get('tarea');
        $activo    = $request->get('activo') == 'on'? false : true;
        $proceso   = $this->em->getRepository(CatProceso::class)->findOneById($idproceso);
        $usuario   = $this->getUser();
        $fecha     = new \DateTime();
        try{
            if($nombTarea)
            
                $subproceso = $this->em->getRepository(Tarea::class)->insertTarea($nombTarea,$proceso,$usuario,$fecha,$activo);
              if($subproceso){
              $this->em->persist($subproceso);
              $this->em->flush();
              $this->em->clear();
              $this->addFlash('success', 'La Tarea fue grabado Satisfactoriamente.');
              }
              else{
                $this->addFlash('error', 'Existe un error a la hora de grabar la tarea.');
              }
            }catch(Exception $e){
            $this->addFlash('error', $e->getMessage());
        }
        return $this->redirectToRoute('app_cat_proceso_index', [], Response::HTTP_SEE_OTHER);  
    }

    #[Route('/{id}', name: 'app_tarea_show', methods: ['GET'])]
    public function show(Tarea $tarea): Response
    {
        return $this->render('tarea/show.html.twig', [
            'tarea' => $tarea,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tarea_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tarea $tarea, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TareaType::class, $tarea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tarea_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tarea/edit.html.twig', [
            'tarea' => $tarea,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tarea_delete', methods: ['POST'])]
    public function delete(Request $request, Tarea $tarea, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tarea->getId(), $request->request->get('_token'))) {
            $entityManager->remove($tarea);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tarea_index', [], Response::HTTP_SEE_OTHER);
    }
}
