<?php

namespace App\Controller;

use App\Entity\Extra;
use App\Form\ExtraType;
use App\Repository\ExtraRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/extra")
 */
class ExtraController extends AbstractController
{
    /**
     * @Route("/", name="extra_index", methods={"GET"})
     */
    public function index(ExtraRepository $extraRepository): Response
    {
        return $this->render('extra/index.html.twig', [
            'extras' => $extraRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="extra_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $extra = new Extra();
        $form = $this->createForm(ExtraType::class, $extra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var UploadedFile $file
             */
            $file=$extra->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtansion();

            $file->move(
              $this->getParameter('image_directory'), $fileName
            );

            $extra->setImage($fileName);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($extra);
            $entityManager->flush();

            return $this->redirectToRoute('extra_index');
        }

        return $this->render('extra/new.html.twig', [
            'extra' => $extra,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="extra_show", methods={"GET"})
     */
    public function show(Extra $extra): Response
    {
        return $this->render('extra/show.html.twig', [
            'extra' => $extra,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="extra_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Extra $extra): Response
    {
        $form = $this->createForm(ExtraType::class, $extra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('extra_index', [
                'id' => $extra->getId(),
            ]);
        }

        return $this->render('extra/edit.html.twig', [
            'extra' => $extra,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="extra_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Extra $extra): Response
    {
        if ($this->isCsrfTokenValid('delete'.$extra->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($extra);
            $entityManager->flush();
        }

        return $this->redirectToRoute('extra_index');
    }
}
