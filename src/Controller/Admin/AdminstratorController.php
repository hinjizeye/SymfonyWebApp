<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminstratorController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_adminstrator")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminstratorController',
        ]);
    }
}
