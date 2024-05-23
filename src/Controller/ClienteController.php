<?php

namespace App\Controller;

use App\Entity\Cliente;
use App\Entity\CliNotas;
use App\Form\ClienteType;
use App\Entity\CatProceso;
use App\Entity\CliContactos;
use App\Entity\VariableInicio;
use App\Repository\ClienteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/cliente')]
class ClienteController extends AbstractController
{
    private $em;

    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager();
    }
    
    #[Route('/', name: 'app_cliente_index', methods: ['GET', 'POST'])]
    public function index(ClienteRepository $clienteRepository): Response
    {
        $clientes = $clienteRepository->findByEliminar(false);
        return $this->render('cliente/index.html.twig', [
            'clientes' => $clientes,
        ]);
    }

    #[Route('/new', name: 'app_cliente_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cliente = new Cliente();
        $form = $this->createForm(ClienteType::class, $cliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cliente);
            $entityManager->flush();

            return $this->redirectToRoute('app_cliente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cliente/new.html.twig', [
            'cliente' => $cliente,
            'form' => $form,
        ]);
    }

    #[Route('/vista/cliente', name: 'app_cliente_show', methods: ['GET', 'POST'])]
    public function show(Request $request): Response
    {
        $clienteid = $request->get('clienteid');
        $accion    = $request->get('accion');
        $cliente   = $this->em->getRepository(Cliente::class)->findOneById($clienteid);
        $contactos = $this->em->getRepository(CliContactos::class)->findBy(array('cliente' => $cliente, 'eliminar' => false));
        $variable  = $this->em->getRepository(VariableInicio::class)->findOneById(2); 
        $depproc   = $this->em->getRepository(CatProceso::class)->findByVariableInicio($variable);
        $actividades = $this->em->getRepository(CliNotas::class)->findByCliente($cliente,array('fechaCreate' => 'desc'));
        
        
        return $this->render('cliente/show.html.twig', [
            'cliente'  => $cliente,
            'Contactos'=> $contactos,
            'depprocesos' => $depproc,
            'actividades' => $actividades,
            ]);

    }

    #[Route('/{id}/edit', name: 'app_cliente_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cliente $cliente, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ClienteType::class, $cliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cliente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cliente/edit.html.twig', [
            'cliente' => $cliente,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cliente_delete', methods: ['POST'])]
    public function delete(Request $request, Cliente $cliente, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cliente->getId(), $request->request->get('_token'))) {
            $entityManager->remove($cliente);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cliente_index', [], Response::HTTP_SEE_OTHER);
    }
}
