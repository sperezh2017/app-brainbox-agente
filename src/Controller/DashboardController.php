<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Entity\Usuario;
use App\Entity\PerfilMenu;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    private $em;

    public function __construct(ManagerRegistry $em)
    {
        $this->em = $em->getManager();
    }

    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(SessionInterface $session): Response
    {
        //$this->accesos(1,$session,$this->em);
        $opMenu = $session->get('menus');
        return $this->render('dashboard/index.html.twig',[
            'menu' => $opMenu,
        ]);
    }
    #[Route('/error-404', name: 'app_error_404')]
    public function error404(): Response
    {
        return $this->render('dashboard/error404.html.twig');
    }

    public function accesos($idmenu)
    {
        $usuario = $this->getUser();
        $perfil  = $usuario->getPerfilid();
        $menu    = $this->em->getRepository(Menu::class)->findOneById($idmenu); 
        $permenu = $this->em->getRepository(PerfilMenu::class)->findOneBy(array('menuid' => $menu, 'perfilid' => $perfil));

        return $permenu;

    }
}
