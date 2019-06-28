<?php

namespace App\Controller;

use App\Entity\Rooms;
use App\Form\RoomsType;
use App\Repository\ReservationRepository;
use App\Repository\RoomsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rooms")
 */
class RoomsController extends AbstractController
{
    /**
     * @Route("/", name="rooms_index", methods={"GET"})
     */
    public function index(RoomsRepository $roomsRepository): Response
    {
        return $this->render('rooms/index.html.twig', [
            'rooms' => $roomsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="rooms_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $room = new Rooms();
        $form = $this->createForm(RoomsType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($room);
            $entityManager->flush();

            return $this->redirectToRoute('rooms_index');
        }

        return $this->render('rooms/new.html.twig', [
            'room' => $room,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rooms_show", methods={"GET"})
     */
    public function show(Rooms $room): Response
    {
        return $this->render('rooms/show.html.twig', [
            'room' => $room,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rooms_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Rooms $room): Response
    {
        $form = $this->createForm(RoomsType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rooms_index', [
                'id' => $room->getId(),
            ]);
        }

        return $this->render('rooms/edit.html.twig', [
            'room' => $room,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rooms_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Rooms $room): Response
    {
        if ($this->isCsrfTokenValid('delete'.$room->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($room);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rooms_index');
    }
    /**
     * @Route("/check", name="rooms_check", methods={"POST"})
     */
    public function checkDate()
    {
        $BeginDate = $_POST["BeginDate"];
        $EndDate = $_POST["EndDate"];

        $reservering = $this->getDoctrine()
            ->getRepository(ReservationRepository::class)
            ->getBetween(array($BeginDate, $EndDate));

        $input = array();
        for ($x = 0; $x < count($reservering); $x++) {
            array_push($input, $reservering[$x][1]);
        }

        $available = $this->getDoctrine()
            ->getRepository(RoomsRepository::class)
            ->notIn($input);

        return $this->render('room/index.html.twig', [
            'rooms' => $available,
        ]);
    }

}
