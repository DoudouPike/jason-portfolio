<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @package App\Controller
 *
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/projects", name="admin_projects")
     */
    public function listProjects()
    {
        $em = $this->getDoctrine()->getManager();
        $em->getRepository('App:Project')->findAll();

        return $this->render('admin/list-projects.html.twig', [
            'controller_name' => 'AdminProjectController',
        ]);
    }
}