<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(NewsRepository $newsRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'news'=>$newsRepository->findAll()
        ]);
    }
}
