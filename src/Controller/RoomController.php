<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ExtraRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RoomController extends AbstractController
{
    /**
     * @Route("/room", name="room_index", methods={"GET"})
     */
    public function index(ExtraRepository $ExtraRepository): Response
    {
        return $this->render('room/index.html.twig', [
            'extra' => $ExtraRepository->findAll(),
        ]);
    }

}


