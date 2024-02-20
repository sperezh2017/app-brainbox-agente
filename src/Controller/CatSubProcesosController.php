<?php

namespace App\Controller;

use Exception;
use App\Entity\CatProceso;
use App\Entity\CatSubProcesos;
use App\Form\CatSubProcesosType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\CatSubProcesosRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/cat/sub/procesos')]
class CatSubProcesosController extends AbstractController
{
    private $em;
    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager();
    }
    
    #[Route('/', name: 'app_cat_sub_procesos_index', methods: ['GET'])]
    public function index(CatSubProcesosRepository $catSubProcesosRepository): Response
    {
        $ultcodigo = $this->em->getRepository(CatSubProcesos::class)->findOneBy(array(), array('id'=>'desc'));
        $procesos  = $this->em->getRepository(CatProceso::class)->findByInactivo(false);
        $subprocesos = $catSubProcesosRepository->findByEliminar(false);
        if(empty($ultcodigo))
                {
                    $ultcodigo = 1;
                }
                else
                {
                    $ultcodigo = $ultcodigo->getId() + 1;
                }
        return $this->render('cat_sub_procesos/index.html.twig', [
            'cat_sub_procesos' => $subprocesos,
            'ultcodigo'  => $ultcodigo,
            'procesos'   => $procesos,
        ]);
    }

    #[Route('/new', name: 'app_cat_sub_procesos_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $idproceso = $request->get('proceso');
        $nombTarea = $request->get('tarea');
        $activo    = $request->get('activo') == 'on'? false : true;
        $proceso   = $this->em->getRepository(CatProceso::class)->findOneById($idproceso);
        
        try{
            if($nombTarea)
            
                $subproceso = $this->em->getRepository(CatSubProcesos::class)->insertSubProceso($id,$subpro,$proceso,$activo);
              if($subproceso){
              $this->em->persist($subproceso);
              $this->em->flush();
              $this->em->clear();
              $this->addFlash('success', 'El grupo fue grabado Satisfactoriamente.');
              }
              else{
                $this->addFlash('error', 'Existe un error a la hora de grabar el grupo.');
              }
            }catch(Exception $e){
            $this->addFlash('error', $e->getMessage());
        }
        return $this->redirectToRoute('app_cat_proceso_index', [], Response::HTTP_SEE_OTHER);  
    }

    #[Route('/{id}', name: 'app_cat_sub_procesos_show', methods: ['GET'])]
    public function show(CatSubProcesos $catSubProceso): Response
    {
        return $this->render('cat_sub_procesos/show.html.twig', [
            'cat_sub_proceso' => $catSubProceso,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cat_sub_procesos_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CatSubProcesos $catSubProceso, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CatSubProcesosType::class, $catSubProceso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cat_sub_procesos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cat_sub_procesos/edit.html.twig', [
            'cat_sub_proceso' => $catSubProceso,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_cat_sub_procesos_delete', methods: ['GET', 'POST'])]
    public function delete(Request $request): Response
    {
        $id = $request->get('id');
        $entity = $this->em->getRepository(CatSubProcesos::class)->findOneById($id);
        try{
            if($entity)
            {
                $entity->setEliminar(true);
                $this->em->persist($entity);
                $this->em->flush();
                $this->em->clear();
                $this->addFlash('success', 'El sub procesos fue eliminado satisfactoriamente.');
            }
        }
        catch(\Exception $e)
        {
            $this->addFlash('error', $e->getMessage());
        }
        return new JsonResponse(array('code' => 200));
    }
}
