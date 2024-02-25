<?php

namespace App\Controller;

use Exception;
use App\Entity\CatMes;
use App\Entity\CatDias;
use App\Entity\CatGrupo;
use App\Entity\CatEntidad;
use App\Entity\CatProceso;
use App\Entity\TipoProceso;
use App\Form\CatProcesoType;
use App\Entity\CatRecurrencia;
use App\Entity\ProcesoLogs;
use App\Entity\VariableInicio;
use App\Repository\CatProcesoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        $nombproc  = $request->get('nombproceso');

        try{
            if($nombproc)
            {
                $procesoid = $request->get('procesoid','');
                $dias      = $request->get('dias',0);
                $mesid     = $request->get('mes');
                $recurrid  = $request->get('recurrencia');
                $diaant    = $request->get('antelacion');
                $entidadid = $request->get('entidad');
                $activo    = $request->get('activo') == 'on'? false : true;
                $tipoid    = $request->get('tipoproceso', 0);
                $varid     = $request->get('variableIni',0);
                $diasemana = $request->get('d-semana',0);
                $despues   = $request->get('vencimiento',0) == 1? true : false;
                $habilitar = $request->get('habilitar') == 'on'? true : false;
                $alta      = $request->get('alta') == 'on'? true : false;
                $nuevo     = 1;

                $usuUpdate = $this->getUser();
                $fechaUpdate = new \DateTime();

                if(empty($despues))
                {
                    $despues = $alta;
                }

              $proceso  = $this->em->getRepository(CatProceso::class)->findOneById($procesoid);
              if($proceso)
              {
                $diaslog      = $proceso->getDia();
                $meslog       = $proceso->getMes();
                $recurrenlog  = $proceso->getRecurrencia();
                $entidadlog   = $proceso->getEntidad();
                $diaantlog    = $proceso->getProantdias();
                $activolog    = $proceso->isInactivo();
                $tipolog      = $proceso->getTipoProceso();
                $variablelog  = $proceso->getVariableInicio();
                $diasemanalog = $proceso->getDiasemana();
                $despueslog   = $proceso->isDespues();
                $habilitarlog = $proceso->isHabFin();
                $usuCreate    = $proceso->getUsuUpdate();
                $fechaCreate  = $proceso->getFechaUpdate();
                $procesologs  = $this->em->getRepository(ProcesoLogs::class)->insertProcesoLogs($proceso,$nombproc,$diaslog,$meslog,$recurrenlog,$entidadlog,$diaantlog,$activolog,$tipolog,$variablelog,$diasemanalog,$despueslog,$habilitarlog,$usuCreate,$usuUpdate,$fechaCreate,$fechaUpdate);
                
                if($procesologs){
                    $this->em->persist($procesologs);
                }
              }
              $mes      = $this->em->getRepository(CatMes::class)->findOneById($mesid);
              $recurren = $this->em->getRepository(CatRecurrencia::class)->findOneById($recurrid);
              $entidad  = $this->em->getRepository(CatEntidad::class)->findOneById($entidadid);
              $tipo     = $this->em->getRepository(TipoProceso::class)->findOneById($tipoid);
              $variable = $this->em->getRepository(VariableInicio::class)->findOneById($varid);
              $proceso  = $this->em->getRepository(CatProceso::class)->insertProceso($nuevo,$proceso,$nombproc,$dias,$mes,$recurren,$entidad,$diaant,$activo,$tipo,$variable,$diasemana,$despues,$habilitar,$usuCreate,$usuUpdate,$fechaCreate,$fechaUpdate);
              
              if($proceso){
              $this->em->persist($proceso);
              $this->em->flush();
              $this->em->clear();
              $this->addFlash('success', 'El proceso fue grabado Satisfactoriamente.');
              }
              else{
                $this->addFlash('error', 'El Proceso ya existe.');
              }
            }
        }catch(Exception $e){
            $this->addFlash('error', $e->getMessage());
        }
        return $this->redirectToRoute('app_cat_proceso_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/vista', name: 'app_cat_proceso_show', methods: ['GET', 'POST'])]
    public function show(Request $request): Response
    {
        $idproceso = $request->get('procesoid');
        $accion    = $request->get('accion');
        $proceso   = $this->em->getRepository(CatProceso::class)->findOneById($idproceso);
        $dias      = $this->em->getRepository(CatDias::class)->findAll();
        $mes       = $this->em->getRepository(CatMes::class)->findAll();
        $recurenc  = $this->em->getRepository(CatRecurrencia::class)->findAll();
        $entidades = $this->em->getRepository(CatEntidad::class)->findAll();
        $grupos    = $this->em->getRepository(CatGrupo::class)->findAll();
        $tipprocess = $this->em->getRepository(TipoProceso::class)->findAll();
        $tipoid     = $proceso->getTipoProceso();
        $variables = $this->em->getRepository(VariableInicio::class)->findByTipoProceso($tipoid);

        if($accion == 'editar')
        {
            return $this->render('cat_proceso/edit.html.twig', [
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
        else
        {
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

    #[Route('/variable', name: 'app_variable_inicio')]
    public function tipoByVariable(Request $request)
    {
        $tipoid = $request->get('tipoid');
        $variables = $this->em->getRepository(VariableInicio::class)->findByTipoProceso($tipoid);

        foreach($variables as $variable)
        {
            $data[] = array(
                'id'       => $variable->getid(),
                'variable' => $variable->getVariable(),
            );
        }

        return new JsonResponse($data);
    }

    #[Route('/logs', name: 'app_cat_proceso_logs', methods: ['GET', 'POST'])]
    public function logs(Request $request): Response
    {
        $idproceso = $request->get('procesoid');
        $proceso   = $this->em->getRepository(CatProceso::class)->findOneById($idproceso);
        $procesologs = $this->em->getRepository(Procesologs::class)->findByProceso($idproceso,array('fechaUpdate'=>'desc'));

            return $this->render('cat_proceso/logs.html.twig', [
                'proceso'     => $proceso,
                'procesologs' => $procesologs,
            ]);
    }
}
