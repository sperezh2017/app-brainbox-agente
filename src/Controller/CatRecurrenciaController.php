<?php

namespace App\Controller;

use Exception;
use App\Entity\CatRecurrencia;
use App\Form\CatRecurrenciaType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\CatRecurrenciaRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/cat/recurrencia')]
class CatRecurrenciaController extends AbstractController
{
    private $em;
    private $accesos;
    public function __construct(ManagerRegistry $em, DashboardController $accesos)
    {
        $this->em = $em->getManager();
        $this->accesos = $accesos;
    }
    
    #[Route('/', name: 'app_cat_recurrencia_index', methods: ['GET'])]
    public function index(CatRecurrenciaRepository $catRecurrenciaRepository): Response
    {
        $recurrencias = $catRecurrenciaRepository->findByEliminar(false);
        $ultcodigo = $this->em->getRepository(CatRecurrencia::class)->findOneBy(array(), array('id'=>'desc'));
        
        if(empty($ultcodigo))
                {
                    $ultcodigo = 1;
                }
                else
                {
                    $ultcodigo = $ultcodigo->getId() + 1;
                }
        $editar   = 0;
        $crear    = 0;
        $eliminar = 0; 
        $permisos = $this->accesos->accesos(1);
        if($permisos)
        {
            $editar   = $permisos->isEditar();
            $crear    = $permisos->isCrear();
            $eliminar = $permisos->isEliminar(); 
        }        
        return $this->render('cat_recurrencia/index.html.twig', [
            'cat_recurrencias' => $recurrencias,
            'ultcodigo'        => $ultcodigo,
            'editar'           => $editar,
            'crear'            => $crear,
            'eliminar'         => $eliminar,   
        ]);
    }

    #[Route('/new', name: 'app_cat_recurrencia_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $id = $request->get('id');
        $recurrencia = $request->get('recurrencia','');
        $activo    = $request->get('activo') == 'on'? false : true;
        
        try{
            if($recurrencia)
            { 
                
              $recurrencias  = $this->em->getRepository(CatRecurrencia::class)->insertRecurrencia($id,$recurrencia,$activo);
              
              if($recurrencias){
              $this->em->persist($recurrencias);
              $this->em->flush();
              $this->em->clear();
              $this->addFlash('success', 'La recurrencia fue grabado Satisfactoriamente.');
              }
              else{
                $this->addFlash('error', 'Existe un error a la hora de grabar la recurrencia.');
              }
            }
            

        }catch(Exception $e){
            $this->addFlash('error', $e->getMessage());
        }

            return $this->redirectToRoute('app_cat_recurrencia_index', [], Response::HTTP_SEE_OTHER);
        }

    #[Route('/{id}', name: 'app_cat_recurrencia_show', methods: ['GET'])]
    public function show(CatRecurrencia $catRecurrencium): Response
    {
        return $this->render('cat_recurrencia/show.html.twig', [
            'cat_recurrencium' => $catRecurrencium,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cat_recurrencia_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CatRecurrencia $catRecurrencium, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CatRecurrenciaType::class, $catRecurrencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cat_recurrencia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cat_recurrencia/edit.html.twig', [
            'cat_recurrencium' => $catRecurrencium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_cat_recurrencia_delete', methods: ['GET', 'POST'])]
    public function delete(Request $request): Response
    {
        $id = $request->get('id');
        $entity = $this->em->getRepository(CatRecurrencia::class)->findOneById($id);
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

    #[Route('/seleccion', name: 'app_recurrencia_seleccion')]
    public function variableByRecurrencia(Request $request)
    {
        $variableid  = $request->get('variableid');
        if($variableid == 4)
        {
            $recurrencias = $this->em->getRepository(CatRecurrencia::class)->findAll();  
        }
        else
        {
            $recurrencias = $this->em->getRepository(CatRecurrencia::class)->findBySeleccion(true);
        }
        

        foreach($recurrencias as $recurrencia)
        {
            $data[] = array(
                'id'       => $recurrencia->getid(),
                'recurrencia' => $recurrencia->getDescripcion(),
            );
        }

        return new JsonResponse($data);
    }
}
