<?php

namespace App\Controller;

use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    /**
     * @Route("/project", name="project")
     */
    public function index()
    {
        return $this->render('project/index.html.twig', [
            'controller_name' => 'ProjectController',
        ]);
    }

    /**
     * @Route("/project/create", name="project_create")
     */
    public function create()
    {
        $em = $this->getDoctrine()->getManager();
        $project = new Project();
        $project->setTitle('my title in fr');
        $project->setDescription('my description in fr');
        $project->setIsFree(true);
        $project->setCreatedAt(new \DateTime());
        $em->persist($project);
        $em->flush();
    }

    /**
     * @Route("/project/update/{id}", name="project_update")
     *
     * @param Request $request
     */
    public function update(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $project = $em->find('App:Project', $request->get('id'));
        $project->setTitle('my title in en');
        $project->setDescription('my description in en');
        $project->setTranslatableLocale('en_en');
        $em->persist($project);
        $em->flush();
    }

    /**
     * @Route("/project/{id}", name="project_show")
     *
     * @param Request $request
     */
    public function show(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $project = $em->find('App:Project', $request->get('id'));

        dump($project);

        $repository = $em->getRepository('\Gedmo\Translatable\Entity\Translation');
        $translations = $repository->findTranslations($project);

        dump($translations);
    }
}