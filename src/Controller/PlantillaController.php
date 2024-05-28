<?php

namespace App\Controller;

use DateTime;
use App\Entity\Cliente;
use App\Entity\CatProceso;
use App\Entity\ProEstados;
use App\Entity\ProEtiquetas;
use App\Entity\ProTransaccion;
use App\Form\ProTransaccionType;
use App\Entity\EstFechaVencimiento;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ProTransaccionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    public function index(): Response
    {
        $etiquetas = $this->em->getRepository(ProEtiquetas::class)->findAll();
        $estados   = $this->em->getRepository(ProEstados::class)->findAll();
        $estFecha  = $this->em->getRepository(EstFechaVencimiento::class)->findAll();
        $clientes  = $this->em->getRepository(Cliente::class)->findAll();
        $procesos  = $this->em->getRepository(CatProceso::class)->findAll();
        $fecha     = new DateTime();
        $clienteId = null;
        $procesoId = null;
        $etiquetaId = null;
        $estadoId   = null;
        $filtFecha  = null;

        // llamar procedimiento almacenado para la recopilacion de las tareas
        $plantillas = $this->em->getRepository(ProTransaccion::class)->buscarPlantillas($fecha,$clienteId,$procesoId,$etiquetaId,$estadoId,$filtFecha);
        return $this->render('plantilla/index.html.twig', [
            'pro_transaccions' => $plantillas,
            'etiquetas' => $etiquetas,
            'estados'   => $estados,
            'estfechas' => $estFecha,
            'clientes'  => $clientes,
            'procesos'  => $procesos, 
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

    #[Route('/edit/plantilla', name: 'app_plantilla_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request): Response
    {
       $id        = $request->get('idplanilla');
       $estado    = $request->get('estado');
       $etiqueta  = $request->get('etiqueta');
       $estado    = $this->em->getRepository(ProEstados::class)->findOneById($estado);
       $etiqueta  = $this->em->getRepository(ProEtiquetas::class)->findOneById($etiqueta);
       $plantilla = $this->em->getRepository(ProTransaccion::class)->findOneById($id);
       if($plantilla)
       {
            $plantilla->setEstado($estado)
                        ->setEtiqueta($etiqueta);
            $this->em->persist($plantilla);
            try{
                $this->em->flush();
                $this->em->clear();
                $mensaje = 200;
            }catch(\Exception $e)
            {
                $mensaje = 400;
            }

            return new JsonResponse(array('res' => $mensaje));
            
       }
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

    #[Route('/filtro/plantilla', name: 'app_plantilla_filtro', methods: ['POST'])]
    public function filtro(Request $request): Response
    {
        $etiquetas = $this->em->getRepository(ProEtiquetas::class)->findAll();
        $estados   = $this->em->getRepository(ProEstados::class)->findAll();
        $fecha     = $request->get('fechacorte');
        $fecha = DateTime::createFromFormat('Y-m-d', $fecha);
        $clienteId = $request->get('cliente')== 0 ? null : $request->get('cliente');
        $procesoId = $request->get('proceso')== 0 ? null : $request->get('proceso');
        $etiquetaId = $request->get('etiqueta')== 0 ? null : $request->get('etiqueta');
        $estadoId   = $request->get('estado')== 0 ? null : $request->get('estado');
        $filtFecha  = $request->get('estfecha')== 0 ? null : $request->get('estfecha');

        // llamar procedimiento almacenado para la recopilacion de las tareas
        $plantillas = $this->em->getRepository(ProTransaccion::class)->buscarPlantillas($fecha,$clienteId,$procesoId,$etiquetaId,$estadoId,$filtFecha);
        return $this->render('plantilla/filtro.html.twig', [
            'pro_transaccions' => $plantillas,
            'etiquetas' => $etiquetas,
            'estados'   => $estados,
        ]);
    }
}
